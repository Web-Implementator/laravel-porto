<?php

declare(strict_types=1);

namespace App\Containers\Car\Data\Transporters;

use App\Ship\Parents\Transporters\Data;

final class RentUpdateDTO extends Data
{
    public function __construct(
        public int $rentId,
        public array $data,
    ) {
    }

    /**
     * @return int
     */
    public function getPrimaryId(): int
    {
        return $this->rentId;
    }
}
