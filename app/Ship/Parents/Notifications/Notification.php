<?php

declare(strict_types=1);

namespace App\Ship\Parents\Notifications;

use Illuminate\Notifications\Notification as IlluminateNotification;
use Illuminate\Support\Facades\Config;

abstract class Notification extends IlluminateNotification
{
    public function via($notifiable): array
    {
        return Config::get('notification.channels');
    }
}
