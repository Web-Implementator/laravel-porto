<?php

declare(strict_types=1);

namespace App\Containers\User\Actions;

use App\Containers\User\Data\Repositories\UserRepository;
use App\Containers\User\Data\Transporters\UserDTO;
use App\Containers\User\Resources\UserResource;
use App\Ship\Abstracts\Actions\Action;

final class UserUpdateAction extends Action
{
    public function __construct(
        protected UserRepository $repository
    ) {
    }

    /**
     * @param UserDTO $dto
     * @return UserResource
     */
    public function run(UserDTO $dto): UserResource
    {
        return $this->repository->update($dto);
    }
}
