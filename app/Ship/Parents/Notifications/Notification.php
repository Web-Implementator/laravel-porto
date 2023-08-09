<?php

declare(strict_types=1);

namespace App\Ship\Parents\Notifications;

use Illuminate\Notifications\Notification as IlluminateNotification;

abstract class Notification extends IlluminateNotification
{
    public function via(): array
    {
        return config('notification.channels');
    }
}
