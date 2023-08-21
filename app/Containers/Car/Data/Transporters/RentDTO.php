<?php

declare(strict_types=1);

namespace App\Containers\Car\Data\Transporters;

use App\Ship\Abstracts\Transporters\DataAbstract;
use Carbon\Carbon;

final class RentDTO extends DataAbstract
{
    public function __construct(
        public ?int $rentId,
        public ?int $carId,
        public ?int $userId,
        public ?Carbon $beginAt,
        public ?Carbon $endAt,
        public ?bool $isCache = true,
    ) {
    }

    /**
     * @return mixed
     */
    public function getPrimaryId(): mixed
    {
        return $this->rentId;
    }
}
