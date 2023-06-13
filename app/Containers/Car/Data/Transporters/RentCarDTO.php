<?php

declare(strict_types=1);

namespace App\Containers\Car\Data\Transporters;

use App\Ship\Parents\Transporters\Data;

final class RentCarDTO extends Data
{
    public function __construct(
        public int $userId,
        public int $carId,
    ) {
    }

    /**
     * @return int
     */
    public function getPrimaryId(): int
    {
        return $this->carId;
    }
}
