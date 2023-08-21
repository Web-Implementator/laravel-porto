<?php

declare(strict_types=1);

namespace App\Ship\Core\Providers;

use App\Containers\Car\Events\CarCacheEvent;
use App\Containers\Car\Events\RentCacheEvent;
use App\Containers\Car\Listeners\CarCacheListener;
use App\Containers\Car\Listeners\RentCacheListener;
use App\Containers\Car\Models\CarModel;
use App\Containers\Car\Models\RentModel;
use App\Containers\Car\Observers\CarObserver;
use App\Containers\Car\Observers\RentObserver;
use App\Ship\Abstracts\Providers\EventServiceProviderAbstract;

final class EventServiceProvider extends EventServiceProviderAbstract
{
    /**
     * The event listener mappings for the application.
     *
     * @const array<class-string, array<int, class-string>>
     */
    protected $listen = [
        CarCacheEvent::class => [
            CarCacheListener::class,
        ],
        RentCacheEvent::class => [
            RentCacheListener::class
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot(): void
    {
        CarModel::observe(new CarObserver());
        RentModel::observe(new RentObserver());
    }
}
