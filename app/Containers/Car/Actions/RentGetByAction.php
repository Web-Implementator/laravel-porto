<?php

declare(strict_types=1);

namespace App\Containers\Car\Actions;

use App\Containers\Car\Data\Repositories\RentRepository;
use App\Containers\Car\Data\Transporters\RentDTO;
use App\Containers\Car\Resources\RentResource;
use App\Ship\Abstracts\Actions\Action;

final class RentGetByAction extends Action
{
    public function __construct(
        protected RentRepository $repository
    ) {
    }

    /**
     * @param RentDTO $dto
     * @return RentResource
     */
    public function run(RentDTO $dto): RentResource
    {
        $id = $dto->getPrimaryId();

        return $this->repository->getBy($id);
    }
}
