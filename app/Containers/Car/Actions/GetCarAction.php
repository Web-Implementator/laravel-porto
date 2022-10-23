<?php

declare(strict_types=1);

namespace App\Containers\Car\Actions;

use App\Containers\Car\Data\Repositories\CarRepository;
use App\Containers\Car\Data\Transporters\GetCarDTO;

use App\Ship\Parents\Actions\Action;

final class GetCarAction extends Action
{
    public function __construct(
        protected CarRepository $repository
    ) {
    }

    /**
     * @param GetCarDTO $dto
     * @return array
     */
    public function run(GetCarDTO $dto): array
    {
        return $this->repository->getByID($dto);
    }
}
