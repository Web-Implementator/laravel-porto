<?php

declare(strict_types=1);

namespace App\Containers\User\Actions;

use App\Containers\User\Data\Repositories\UserRepository;
use App\Containers\User\Data\Transporters\UserDTO;
use App\Ship\Abstracts\Actions\Action;

final class UserDeleteAction extends Action
{
    public function __construct(
        protected UserRepository $repository
    ) {
    }

    /**
     * @param UserDTO $dto
     * @return array
     */
    public function run(UserDTO $dto): array
    {
        $this->repository->delete($dto);

        return [
            'status' => true
        ];
    }
}
