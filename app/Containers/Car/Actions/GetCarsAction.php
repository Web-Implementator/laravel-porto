<?php

declare(strict_types=1);

namespace App\Containers\Car\Actions;

use App\Containers\Car\Data\Repositories\CarRepository;

use App\Ship\Parents\Actions\Action;

final class GetCarsAction extends Action
{
    public function __construct(
        protected CarRepository $repository
    ) {
    }

    /**
     * @return array
     */
    public function run(): array
    {
        return $this->repository->getAll();
    }
}
