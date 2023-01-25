<?php

declare(strict_types=1);

namespace App\Containers\Car\Actions;

use App\Containers\Car\Data\Repositories\RentRepository;
use App\Containers\Car\Data\Transporters\GetRentDTO;
use App\Containers\Car\Resources\CarResource;

use App\Ship\Parents\Actions\Action;

final class GetRentAction extends Action
{
    public function __construct(
        protected RentRepository $repository
    ) {
    }

    /**
     * @param GetRentDTO $dto
     * @return CarResource
     */
    public function run(GetRentDTO $dto): CarResource
    {
        return $this->repository->getByID($dto);
    }
}
