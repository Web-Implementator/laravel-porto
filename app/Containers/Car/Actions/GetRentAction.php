<?php

declare(strict_types=1);

namespace App\Containers\Car\Actions;

use App\Containers\Car\Data\Repositories\RentRepository;
use App\Containers\Car\Data\Transporters\GetRentDTO;
use App\Containers\Car\Resources\CarResource;
use App\Containers\Car\Resources\RentResource;
use App\Ship\Parents\Actions\Action;

final class GetRentAction extends Action
{
    public function __construct(
        protected RentRepository $repository
    ) {
    }

    /**
     * @param GetRentDTO $dto
     * @return RentResource
     */
    public function run(GetRentDTO $dto): RentResource
    {
        $id = $dto->getPrimaryId();

        return $this->repository->getByID($id);
    }
}
