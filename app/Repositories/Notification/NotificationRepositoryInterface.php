<?php

namespace App\Repositories\Notification;

interface NotificationRepositoryInterface
{
    public function getNotificationPending();

    public function getNotificationApproved();
}
