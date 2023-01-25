<?php

declare(strict_types=1);

namespace App\Containers\Car\Actions;

use App\Containers\Car\Data\Repositories\RentRepository;
use App\Ship\Parents\Actions\Action;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

final class GetRentsAction extends Action
{
    public function __construct(
        protected RentRepository $repository
    ) {
    }

    /**
     * @return AnonymousResourceCollection
     */
    public function run(): AnonymousResourceCollection
    {
        return $this->repository->getAll();
    }
}
