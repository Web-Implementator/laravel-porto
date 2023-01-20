<?php

declare(strict_types=1);

namespace App\Ship\Parents\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as IlluminateEventServiceProvider;

final class EventServiceProvider extends IlluminateEventServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @const array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot(): void
    {
        //
    }
}
