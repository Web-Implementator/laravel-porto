<?php

declare(strict_types=1);

namespace App\Containers\Car\Observers;

use App\Containers\Car\Events\RentCacheEvent;
use App\Containers\Car\Models\RentModel;

class RentObserver
{
    /**
     * @param RentModel $model
     * @return void
     */
    public function created(RentModel $model): void
    {
        event(new RentCacheEvent($model));
    }

    /**
     * @param RentModel $model
     * @return void
     */
    public function updated(RentModel $model): void
    {
        event(new RentCacheEvent($model));
    }

    /**
     * @param RentModel $model
     * @return void
     */
    public function deleted(RentModel $model): void
    {
        event(new RentCacheEvent($model));
    }

    /**
     * @param RentModel $model
     * @return void
     */
    public function restored(RentModel $model): void
    {
        event(new RentCacheEvent($model));
    }

    /**
     * @param RentModel $model
     * @return void
     */
    public function forceDeleted(RentModel $model): void
    {
        event(new RentCacheEvent($model));
    }
}
