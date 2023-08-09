<?php

declare(strict_types=1);

namespace App\Containers\Car\Data\Transporters;

use App\Ship\Abstracts\Transporters\DataAbstract;

final class RentCarDTO extends DataAbstract
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
