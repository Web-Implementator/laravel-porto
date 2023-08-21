<?php

declare(strict_types=1);

namespace App\Containers\Car\Actions;

use App\Containers\Car\Data\Repositories\CarRepository;
use App\Containers\Car\Data\Transporters\CarDTO;
use App\Containers\Car\Resources\CarCollection;
use App\Ship\Abstracts\Actions\Action;

final class CarGetAllAction extends Action
{
    public function __construct(
        protected CarRepository $repository
    ) {
    }

    /**
     * @param CarDTO $dto
     * @return CarCollection
     */
    public function run(CarDTO $dto): CarCollection
    {
        return $this->repository->getAll($dto);
    }
}
