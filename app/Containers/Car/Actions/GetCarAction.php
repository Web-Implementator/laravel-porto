<?php

declare(strict_types=1);

namespace App\Containers\Car\Actions;

use App\Containers\Car\Data\Repositories\CarRepository;
use App\Containers\Car\Data\Transporters\GetCarDTO;
use App\Containers\Car\Resources\CarResource;
use App\Ship\Abstracts\Actions\Action;

final class GetCarAction extends Action
{
    public function __construct(
        protected CarRepository $repository
    ) {
    }

    /**
     * @param GetCarDTO $dto
     * @return CarResource
     */
    public function run(GetCarDTO $dto): CarResource
    {
        return $this->repository->getByID($dto->carId);
    }
}
