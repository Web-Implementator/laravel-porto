<?php

declare(strict_types=1);

namespace App\Containers\Car\Events;

use App\Containers\Car\Models\CarModel;
use App\Ship\Abstracts\Events\EventAbstract;

final class CarCacheEvent extends EventAbstract
{
    public function __construct(
        public CarModel $model,
    ) {
    }
}
