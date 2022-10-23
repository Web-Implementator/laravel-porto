<?php

declare(strict_types=1);

namespace App\Containers\User\Actions;

use App\Containers\User\Data\Repositories\UserRepository;

use App\Ship\Parents\Actions\Action;

final class GetUsersAction extends Action
{
    public function __construct(
        protected UserRepository $repository
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
