<?php

declare(strict_types=1);

namespace App\Containers\Car\Actions;

use App\Containers\Car\Data\Repositories\RentRepository;
use App\Containers\Car\Data\Transporters\RentDTO;
use App\Containers\Car\Resources\RentCollection;
use App\Ship\Abstracts\Actions\Action;

final class RentGetAllAction extends Action
{
    public function __construct(
        protected RentRepository $repository
    ) {
    }

    /**
     * @param RentDTO $dto
     * @return RentCollection
     */
    public function run(RentDTO $dto): RentCollection
    {
        return $this->repository->getAll($dto);
    }
}
