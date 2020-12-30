<?php

namespace Tests\Unit\Jobs;

use Tests\TestCase;
use App\Models\Order;
use Illuminate\Support\Str;
use App\Jobs\SendMailJob;
use App\Mail\ApprovedOrderMail;
use Illuminate\Support\Facades\Mail;

class SendMailJobTest extends TestCase
{
    protected $data;
    protected $job;

    public function setUp() : void
    {
        parent::setUp();
        $this->data = [
            'email' => 'abcd@gmail.com',
            'name' => Str::random(100),
            'order' => factory(Order::class)->make(),
            'itemInOrder' => Str::random(100),
        ];
        $this->job = new SendMailJob($this->data);
    }

    public function tearDown() : void
    {
        unset($this->job);
        unset($this->data);
        parent::tearDown();
    }

    public function test_handle_function()
    {
        Mail::fake();
        $this->job->handle();
        Mail::assertSent(ApprovedOrderMail::class, function ($mail) {
            return $mail->hasTo($this->data['email']);
        });
    }
}
