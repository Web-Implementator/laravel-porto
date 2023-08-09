<?php

declare(strict_types=1);

namespace App\Containers\User\Actions;

use App\Containers\User\Data\Repositories\UserRepository;
use App\Containers\User\Data\Transporters\GetUserDTO;
use App\Containers\User\Resources\UserResource;
use App\Ship\Abstracts\Actions\Action;

final class GetUserAction extends Action
{
    public function __construct(
        protected UserRepository $repository
    ) {
    }

    /**
     * @param GetUserDTO $dto
     * @return UserResource
     */
    public function run(GetUserDTO $dto): UserResource
    {
        $id = $dto->getPrimaryId();

        return $this->repository->getById($id);
    }
}
