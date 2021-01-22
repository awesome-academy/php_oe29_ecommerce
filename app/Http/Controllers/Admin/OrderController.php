<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Mockery\Exception;
use Illuminate\Support\Facades\DB;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\ProductDetails\ProductDetailRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Notification\NotificationRepositoryInterface;
use App\Notifications\Admin\CensoredOrderNotification;
use Pusher\Pusher;
use App\Models\Notification;
use App\Jobs\SendMailJob;

class OrderController extends Controller
{
    protected $userRepo;
    protected $orderRepo;
    protected $productDetailRepo;
    protected $notificationRepo;

    public function __construct(
        UserRepositoryInterface $userRepo,
        OrderRepositoryInterface $orderRepo,
        ProductDetailRepositoryInterface $productDetailRepo,
        NotificationRepositoryInterface $notificationRepo
    ) {
        $this->userRepo = $userRepo;
        $this->orderRepo = $orderRepo;
        $this->productDetailRepo = $productDetailRepo;
        $this->notificationRepo = $notificationRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->can('viewAny', Order::class)) {
            $orders = $this->orderRepo->orderBy('status', 'productDetails');

            return view('admin.orders.index', compact('orders'));
        }

        return abort(config('setting.errors404'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = $this->orderRepo->find($id, ['productDetails', 'user']);
        $productDetails = $order->productDetails;
        $user = $order->user;

        return view('admin.orders.modal_detail_order', compact('order', 'productDetails', 'user'));
    }

    public function approvedOrder($id)
    {
        // DB::beginTransaction();
        $data = [
            'status' => config('setting.http_status.success'),
            'message' => trans('message_success'),
        ];
        try {
            $order = $this->orderRepo->find($id, ['productDetails']);
            if ($order->status != config('order.status.approved')) {
                $productDetails = $order->productDetails;
                foreach ($productDetails as $productDetail) {
                    if ($productDetail->deleted_at == null) {
                        if ($productDetail->quantity >= $productDetail->pivot->quantity) {
                            $this->productDetailRepo->update($productDetail->id, [
                                'quantity' => $productDetail->quantity - $productDetail->pivot->quantity,
                            ]);
                        } else {
                            $data['status'] = config('setting.http_status.error');
                            $data['message'] = trans('admin.order.not_enough');

                            return json_encode($data);
                        }
                    } else {
                        $data['status'] = config('setting.http_status.error');
                        $data['message'] = trans('product_not_exists');

                        return json_encode($data);
                    }
                }
                $this->orderRepo->update($id, [
                    'status' => config('order.status.approved'),
                ]);
                $data['id'] = $order->id;
                $data['approved'] = trans('admin.approved');
                $user = $this->userRepo->find($order->user_id);
                $itemInOrder = [];
                foreach ($order->productDetails as $productDetail) {
                    $item = [
                        'product_detail_name' => $productDetail->product->name,
                        'quantity' => $productDetail->pivot->quantity,
                        'unit_price' => $productDetail->pivot->unit_price,
                    ];
                    array_push($itemInOrder, $item);
                }
                $dataToJob = [
                    'email' => $user->email,
                    'name' => $user->name,
                    'order' => $order,
                    'itemInOrder' => $itemInOrder,
                ];
                $this->dispatch(new SendMailJob($dataToJob));
                $notification = [
                    'admin_id' => Auth::id(),
                    'order_id' => $order->id,
                    'title' => 'admin.notification.order_approved.title',
                    'content' => 'admin.notification.order_approved.content',
                ];
                $user->notify(new CensoredOrderNotification($notification));
                $options = array(
                    'cluster' => 'ap1',
                    'encrypted' => true
                );
                $pusher = new Pusher(
                    env('PUSHER_APP_KEY'),
                    env('PUSHER_APP_SECRET'),
                    env('PUSHER_APP_ID'),
                    $options
                );
                $newestNotification = $this->notificationRepo->getNotificationApproved();
                $data = [
                    'id' => json_decode($newestNotification->data)->admin_id,
                    'title' => 'admin.notification.order_approved.title',
                    'content' => 'admin.notification.order_approved.content',
                ];
                $pusher->trigger('NotificationEvent', 'send-message', $data);
                // DB::commit();

                return json_encode($data);
            } else {
                $data['status'] = config('setting.http_status.serve');
                $data['message'] = trans('admin.order.approved_error');

                return  json_encode($data);
            }
        } catch (Exception $exception) {
            // DB::rollBack();
            $data['status'] = config('setting.http_status.error');
            $data['message'] = trans('message_errors');

            return json_encode($data);
        }
    }

    public function rejectedOrder($id)
    {
        DB::beginTransaction();
        $data = [
            'status' => config('setting.http_status.success'),
            'message' => trans('message_success'),
        ];
        try {
            $order = $this->orderRepo->find($id, ['productDetails']);
            if ($order->status != config('order.status.rejected')
                && $order->status != config('order.status.approved')) {
                $this->orderRepo->update($order->id, [
                   'status' => config('order.status.rejected')
                ]);
                $data['id'] = $order->id;
                $data['rejected'] = trans('admin.rejected');
                $user = $this->userRepo->find($order->user_id);
                $notification = [
                    'admin_id' => Auth::id(),
                    'order_id' => $order->id,
                    'title' => 'admin.notification.order_rejected.title',
                    'content' => 'admin.notification.order_rejected.content',
                ];
                $user->notify(new CensoredOrderNotification($notification));
                $options = array(
                    'cluster' => 'ap1',
                    'encrypted' => true
                );
                $pusher = new Pusher(
                    env('PUSHER_APP_KEY'),
                    env('PUSHER_APP_SECRET'),
                    env('PUSHER_APP_ID'),
                    $options
                );
                $newestNotification = Notification::where('type', 'App\Notifications\Admin\CensoredOrderNotification')->orderBy('created_at', 'desc')->first();
                $data = [
                    'id' => json_decode($newestNotification->data)->admin_id,
                    'title' => 'admin.notification.order_rejected.title',
                    'content' => 'admin.notification.order_rejected.content',
                ];
                $pusher->trigger('NotificationEvent', 'send-message', $notification);
                DB::commit();

                return json_encode($data);
            } elseif ($order->status == config('order.status.approved')) {
                $productDetails = $order->productDetails;
                foreach ($productDetails as $productDetail) {
                    if ($productDetail->quantity >= $productDetail->pivot->quantity) {
                        $this->productDetailRepo->update($productDetail->id, [
                            'quantity' => $productDetail->quantity + $productDetail->pivot->quantity,
                        ]);
                    }
                }
                $this->orderRepo->update($order->id, [
                    'status' => config('order.status.rejected')
                ]);
                $data['id'] = $order->id;
                $data['rejected'] = trans('admin.rejected');
                $user = $this->userRepo->find($order->user_id);
                $notification = [
                    'admin_id' => Auth::id(),
                    'order_id' => $order->id,
                    'title' => 'admin.notification.order_rejected.title',
                    'content' => 'admin.notification.order_rejected.content',
                ];
                $user->notify(new CensoredOrderNotification($notification));
                $options = array(
                    'cluster' => 'ap1',
                    'encrypted' => true
                );
                $pusher = new Pusher(
                    env('PUSHER_APP_KEY'),
                    env('PUSHER_APP_SECRET'),
                    env('PUSHER_APP_ID'),
                    $options
                );
                $newestNotification = Notification::where('type', 'App\Notifications\Admin\CensoredOrderNotification')->orderBy('created_at', 'desc')->first();
                $data = [
                    'id' => json_decode($newestNotification->data)->admin_id,
                    'title' => 'admin.notification.order_rejected.title',
                    'content' => 'admin.notification.order_rejected.content',
                ];
                $pusher->trigger('NotificationEvent', 'send-message', $notification);
                DB::commit();

                return json_encode($data);
            } else {
                $data['status'] = config('setting.http_status.serve');
                $data['message'] = trans('admin.order.rejected_error');

                return  json_encode($data);
            }
        } catch (Exception $exception) {
            DB::rollBack();
            $data['status'] = config('setting.http_status.error');
            $data['message'] = trans('message_errors');

            return json_encode($data);
        }
    }
}
