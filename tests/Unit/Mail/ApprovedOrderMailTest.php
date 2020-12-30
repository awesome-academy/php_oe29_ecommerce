<?php

namespace Tests\Unit\Mail;

use Tests\TestCase;
use App\Mail\ApprovedOrderMail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Markdown;
use App\Models\Order;

class ApprovedOrderMailTest extends TestCase
{
    protected $data, $approvedOrder;

    public function setUp() : void
    {
        parent::setUp();
        $this->data = [
            'name' => Str::random(100),
            'order' => factory(Order::class)->make(),
            'itemInOrder' => [
                [
                    'product_detail_name' => Str::random(100),
                    'quantity' => rand(),
                    'unit_price' =>rand(),
                ],
            ],
        ];
        $this->approvedOrder = new ApprovedOrderMail($this->data);
    }

    public function tearDown() : void
    {
        unset($this->approvedOrder);
        unset($this->data);
        parent::tearDown();
    }

    public function test_build_function()
    {
        Mail::fake();
        Mail::send($this->approvedOrder);
        $this->approvedOrder->build();
        Mail::assertSent(ApprovedOrderMail::class, function($mail) {
            return $mail->subject == trans('email.approved_order.subject');
        });
        $this->assertEquals($this->data['name'], $this->approvedOrder->buildViewData()['name']);
        $this->assertEquals($this->data['order'], $this->approvedOrder->buildViewData()['order']);
        $this->assertEquals($this->data['itemInOrder'], $this->approvedOrder->buildViewData()['itemInOrder']);
    }
}
