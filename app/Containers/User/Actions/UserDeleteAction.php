<?php

declare(strict_types=1);

namespace App\Containers\User\Actions;

use App\Containers\User\Data\Repositories\UserRepository;
use App\Containers\User\Data\Transporters\GetUserDTO;
use App\Containers\User\Resources\UserResource;

use App\Ship\Parents\Actions\Action;

final class UserDeleteAction extends Action
{
    public function __construct(
        protected UserRepository $repository
    ) {
    }

    /**
     * @param int $id
     * @return bool
     */
    public function run(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
