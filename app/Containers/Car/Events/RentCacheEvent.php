<?php

declare(strict_types=1);

namespace App\Containers\Car\Events;

use App\Containers\Car\Models\RentModel;
use App\Ship\Abstracts\Events\EventAbstract;

final class RentCacheEvent extends EventAbstract
{
    public function __construct(
        public RentModel $model,
    ) {
    }
}
