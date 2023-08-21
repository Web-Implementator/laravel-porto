<?php

declare(strict_types=1);

namespace App\Containers\Car\Observers;

use App\Containers\Car\Events\CarCacheEvent;
use App\Containers\Car\Models\CarModel;

class CarObserver
{
    /**
     * @param CarModel $model
     * @return void
     */
    public function created(CarModel $model): void
    {
        event(new CarCacheEvent($model));
    }

    /**
     * @param CarModel $model
     * @return void
     */
    public function updated(CarModel $model): void
    {
        event(new CarCacheEvent($model));
    }

    /**
     * @param CarModel $model
     * @return void
     */
    public function deleted(CarModel $model): void
    {
        event(new CarCacheEvent($model));
    }

    /**
     * @param CarModel $model
     * @return void
     */
    public function restored(CarModel $model): void
    {
        event(new CarCacheEvent($model));
    }

    /**
     * @param CarModel $model
     * @return void
     */
    public function forceDeleted(CarModel $model): void
    {
        event(new CarCacheEvent($model));
    }
}
