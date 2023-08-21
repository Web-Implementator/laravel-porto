<?php

declare(strict_types=1);

namespace App\Containers\Car\Data\Transporters;

use App\Ship\Abstracts\Transporters\DataAbstract;

final class CarDTO extends DataAbstract
{
    public function __construct(
        public ?int $carId,
        public ?string $brand,
        public ?string $model,
        public ?string $stateNumber,
        public ?int $statusId,
        public ?bool $isCache = true,
    ) {
    }

    /**
     * @return mixed
     */
    public function getPrimaryId(): mixed
    {
        return $this->carId;
    }
}
