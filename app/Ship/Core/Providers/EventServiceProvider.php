<?php

declare(strict_types=1);

namespace App\Ship\Core\Providers;

use App\Ship\Abstracts\Providers\EventServiceProviderAbstract;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;

final class EventServiceProvider extends EventServiceProviderAbstract
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
