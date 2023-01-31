<?php

declare(strict_types=1);

namespace App\Containers\User\Actions;

use App\Containers\User\Data\Repositories\UserRepository;

use App\Containers\User\Data\Transporters\GetUserDTO;
use App\Containers\User\Data\Transporters\UserRegisterDTO;
use App\Containers\User\Resources\UserResource;
use App\Ship\Parents\Actions\Action;

use Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;

final class UserRegisterAction extends Action
{
    public function __construct(
        protected UserRepository $repository
    ) {
    }

    /**
     * @param UserRegisterDTO $dto
     * @return UserResource
     * @throws \Exception
     */
    public function run(UserRegisterDTO $dto): UserResource
    {
        try {
            $this->repository->getBy(new GetUserDTO(email: $dto->email));
            throw new \Exception('Введённый Email уже есть в системе');
        } catch (ModelNotFoundException $e) {
            return $this->repository->create($dto->toArray());
        }
    }
}
