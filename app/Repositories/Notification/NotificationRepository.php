<?php

namespace App\Repositories\Notification;

use App\Models\Notification;
use App\Notifications\UserCheckoutNotification;
use App\Notifications\Admin\CensoredOrderNotification;
use App\Repositories\BaseRepository;

class NotificationRepository extends BaseRepository implements NotificationRepositoryInterface
{

    public function getModel()
    {
        return Notification::class;
    }

    public function getNotificationPending()
    {
        return Notification::orderBy('created_at', 'DESC')->where('type', UserCheckoutNotification::class)->get();
    }

    public function getNotificationApproved()
    {
        return Notification::where('type', CensoredOrderNotification::class)->orderBy('created_at', 'desc')->first();
    }
}
