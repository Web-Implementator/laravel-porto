<?php

declare(strict_types=1);

namespace App\Containers\Car\Actions;

use App\Containers\Car\Data\Repositories\CarRepository;
use App\Containers\Car\Resources\CarCollection;
use App\Ship\Abstracts\Actions\Action;

final class GetCarsAction extends Action
{
    public function __construct(
        protected CarRepository $repository
    ) {
    }

    /**
     * @return CarCollection
     */
    public function run(): CarCollection
    {
        return $this->repository->getAll();
    }
}
