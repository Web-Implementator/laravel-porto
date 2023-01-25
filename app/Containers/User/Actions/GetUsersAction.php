<?php

declare(strict_types=1);

namespace App\Containers\User\Actions;

use App\Containers\User\Data\Repositories\UserRepository;

use App\Ship\Parents\Actions\Action;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

final class GetUsersAction extends Action
{
    public function __construct(
        protected UserRepository $repository
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
