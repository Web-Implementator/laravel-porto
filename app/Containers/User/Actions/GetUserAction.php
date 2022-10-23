<?php

declare(strict_types=1);

namespace App\Containers\User\Actions;

use App\Containers\User\Data\Repositories\UserRepository;
use App\Containers\User\Data\Transporters\GetUserDTO;

use App\Ship\Parents\Actions\Action;

final class GetUserAction extends Action
{
    public function __construct(
        protected UserRepository $repository
    ) {
    }

    /**
     * @param GetUserDTO $dto
     * @return array
     */
    public function run(GetUserDTO $dto): array
    {
        return $this->repository->getById($dto);
    }
}
