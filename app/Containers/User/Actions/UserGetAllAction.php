<?php

declare(strict_types=1);

namespace App\Containers\User\Actions;

use App\Containers\User\Data\Repositories\UserRepository;
use App\Containers\User\Data\Transporters\UserDTO;
use App\Containers\User\Resources\UserCollection;
use App\Ship\Abstracts\Actions\Action;

final class UserGetAllAction extends Action
{
    public function __construct(
        protected UserRepository $repository
    ) {
    }

    /**
     * @param UserDTO $dto
     * @return UserCollection
     */
    public function run(UserDTO $dto): UserCollection
    {
        return $this->repository->getAll($dto);
    }
}
