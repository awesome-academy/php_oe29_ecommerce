<?php

namespace Tests\Unit\Http\Controllers\Admin;

use Tests\TestCase;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Notification;
use App\Http\Controllers\Admin\OrderController;
use App\Notifications\Admin\CensoredOrderNotification;
use App\Models\User;
use App\Models\Order;
use App\Models\ProductDetail;
use App\Models\OrderProductDetail;
use App\Models\Product;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\ProductDetails\ProductDetailRepositoryInterface;
use App\Repositories\Notification\NotificationRepositoryInterface;
use Mockery;
use DateTime;

class OrderControllerTest extends TestCase
{
    protected $userMock;
    protected $orderMock;
    protected $productDetailMock;
    protected $notificationMock;
    protected $controller;

    public function setUp(): void
    {
        parent::setUp();
        $this->userMock = Mockery::mock(UserRepositoryInterface::class)->makePartial();
        $this->orderMock = Mockery::mock(OrderRepositoryInterface::class)->makePartial();
        $this->productDetailMock = Mockery::mock(ProductDetailRepositoryInterface::class)->makePartial();
        $this->notificationMock = Mockery::mock(NotificationRepositoryInterface::class)->makePartial();
        $this->controller = new OrderController($this->userMock, $this->orderMock, $this->productDetailMock, $this->notificationMock);
    }

    public function tearDown(): void
    {
        Mockery::close();
        unset($this->controller);
        parent::tearDown();
    }

    public function test_approved_order_status_not_approved()
    {
        $orderId = 100;
        $order = factory(Order::class)->make([
            'id' => $orderId,
            'status' => config('order.status.approved'),
        ]);
        $this->orderMock
            ->shouldReceive('find')
            ->andReturn($order);
        $this->controller->approvedOrder($orderId);
        $this->assertEquals($order->status, config('order.status.approved'));
    }

    public function test_approved_order_product_detail_is_deleted()
    {
        $orderId = 100;
        $productDetail = 100;
        $order = factory(Order::class)->make([
            'id' => $orderId,
            'status' => 1,
        ]);
        $productDetails = factory(ProductDetail::class, 1)->make([
            'deleted_at' => new DateTime,
        ]);
        $order->setRelation('productDetails', $productDetails);
        $this->orderMock
            ->shouldReceive('find')
            ->andReturn($order);
        $this->controller->approvedOrder($orderId);
        $this->assertNotEquals($order->status, config('order.status.approved'));
        $this->assertNotEquals($productDetails[0]->deleted_at, null);
    }

    public function test_approved_order_product_detail_not_enought_quantity()
    {
        $orderId = 100;
        $productDetailId = 100;
        $order = factory(Order::class)->make([
            'id' => $orderId,
            'status' => 1,
        ]);
        $productDetails = factory(ProductDetail::class, 1)->make([
            'id' => $productDetailId,
            'product_id' => 10,
            'quantity' => 10,
        ]);
        $orderProductDetail = factory(OrderProductDetail::class)->make([
            'order_id' => $orderId,
            'product_detail_id' => $productDetailId,
            'quantity' => 100,
        ]);
        $productDetails[0]->setRelation('pivot', $orderProductDetail);
        $order->setRelation('productDetails', $productDetails);
        $this->orderMock
            ->shouldReceive('find')
            ->andReturn($order);
        $this->controller->approvedOrder($orderId);
        $this->assertNotEquals($order->status, config('order.status.approved'));
        $this->assertEquals($order->productDetails[0]->deleted_at, null);
        $this->assertGreaterThan($productDetails[0]->quantity, $productDetails[0]->pivot->quantity);
    }

    public function test_approved_order_function()
    {
        $orderId = 100;
        $productDetailId = 100;
        $order = factory(Order::class)->make([
            'id' => $orderId,
            'status' => 1,
        ]);
        $productDetails = factory(ProductDetail::class, 1)->make([
            'id' => $productDetailId,
            'product_id' => 10,
            'quantity' => 10,
        ]);
        $orderProductDetail = factory(OrderProductDetail::class)->make([
            'order_id' => $orderId,
            'product_detail_id' => $productDetailId,
            'quantity' => 1,
        ]);
        $productDetails[0]->setRelation('pivot', $orderProductDetail);
        $order->setRelation('productDetails', $productDetails);
        $this->orderMock
            ->shouldReceive('find')
            ->andReturn($order);
        $this->orderMock
            ->shouldReceive('update')
            ->andReturn(true);
        $this->productDetailMock
            ->shouldReceive('update')
            ->andReturn(true);
        $user = factory(User::class)->make();
        $this->userMock
            ->shouldReceive('find')
            ->andReturn($user);
        Notification::fake();
        $data = [
            "admin_id" => 6,
            "order_id" => $orderId,
            "title" => Str::random(100),
            "content"=> Str::random(100),
        ];
        $notification = new Notification();
        $notification->data = json_encode($data);
        $this->notificationMock
            ->shouldReceive('getNotificationApproved')
            ->andReturn($notification);
        $this->controller->approvedOrder($orderId);
        $this->assertNotEquals($order->status, config('order.status.approved'));
        $this->assertEquals($order->productDetails[0]->deleted_at, null);
        $this->assertLessThanOrEqual($productDetails[0]->quantity, $productDetails[0]->pivot->quantity);
        Notification::assertSentTo($user, CensoredOrderNotification::class);
    }
}
