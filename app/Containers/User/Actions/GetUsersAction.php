<?php

declare(strict_types=1);

namespace App\Containers\User\Actions;

use App\Containers\User\Data\Repositories\UserRepository;
use App\Containers\User\Resources\UserCollection;
use App\Ship\Parents\Actions\Action;

final class GetUsersAction extends Action
{
    public function __construct(
        protected UserRepository $repository
    ) {
    }

    /**
     * @return UserCollection
     */
    public function run(): UserCollection
    {
        return $this->repository->getAll();
    }
}
