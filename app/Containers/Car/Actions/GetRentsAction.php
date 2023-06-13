<?php

declare(strict_types=1);

namespace App\Containers\Car\Actions;

use App\Containers\Car\Data\Repositories\RentRepository;
use App\Containers\Car\Resources\RentCollection;
use App\Ship\Parents\Actions\Action;

final class GetRentsAction extends Action
{
    public function __construct(
        protected RentRepository $repository
    ) {
    }

    /**
     * @return RentCollection
     */
    public function run(): RentCollection
    {
        return $this->repository->getAll();
    }
}
