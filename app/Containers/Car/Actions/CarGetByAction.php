<?php

declare(strict_types=1);

namespace App\Containers\Car\Actions;

use App\Containers\Car\Data\Repositories\CarRepository;
use App\Containers\Car\Data\Transporters\CarDTO;
use App\Containers\Car\Resources\CarResource;
use App\Ship\Abstracts\Actions\Action;

final class CarGetByAction extends Action
{
    public function __construct(
        protected CarRepository $repository
    ) {
    }

    /**
     * @param CarDTO $dto
     * @return CarResource
     */
    public function run(CarDTO $dto): CarResource
    {
        return $this->repository->getBy($dto);
    }
}
