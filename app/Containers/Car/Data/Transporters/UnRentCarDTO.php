<?php

declare(strict_types=1);

namespace App\Containers\Car\Data\Transporters;

use App\Ship\Abstracts\Transporters\DataAbstract;

final class UnRentCarDTO extends DataAbstract
{
    public function __construct(
        public ?int $rentId,
        public int $userId,
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
