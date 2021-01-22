<?php

namespace Tests\Unit\Notifications\Admin;

use Tests\TestCase;
use App\Notifications\Admin\CensoredOrderNotification;
use App\Models\User;
use Illuminate\Support\Str;

class CensoredOrderNotificationTest extends TestCase
{
    protected $data;
    protected $notification;

    public function setUp() : void
    {
        parent::setUp();
        $this->data = [
            'admin_id' => rand(),
            'order_id' => rand(),
            'title' => Str::random(10),
            'content' => Str::random(100),
        ];
        $this->notification = new CensoredOrderNotification($this->data);
    }

    public function tearDown() : void
    {
        unset($this->notification);
        unset($this->data);
        parent::tearDown();
    }

    public function test_via_function()
    {
        $this->assertEquals(['database'], $this->notification->via(User::class));
    }

    public function test_to_array_function()
    {
        $this->assertEquals($this->data, $this->notification->toArray(User::class));
    }
}
