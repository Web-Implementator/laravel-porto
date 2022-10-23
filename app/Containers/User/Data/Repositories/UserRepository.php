<?php

declare(strict_types=1);

namespace App\Containers\User\Data\Repositories;

use App\Containers\User\Contracts\UserRepositoryInterface;
use App\Containers\User\Data\Transporters\GetUserDTO;
use App\Containers\User\Data\Transporters\UserUpdateDTO;
use App\Containers\User\Models\UserModel;

use App\Ship\Parents\Repositories\Repository;

final class UserRepository extends Repository implements UserRepositoryInterface
{
    /**
     * @return array
     */
    public function getAll(): array
    {
        return UserModel::active()->get()->toArray();
    }

    /**
     * @param GetUserDTO $dto
     * @return array
     */
    public function getById(GetUserDTO $dto): array
    {
        return UserModel::active()->findOrFail($dto->id)->toArray();
    }

    /**
     * @param UserUpdateDTO $dto
     * @return array
     */
    public function update(UserUpdateDTO $dto): array
    {
        return UserModel::whereId($dto->id)->update($dto->details->toArray())->toArray();
    }

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id): void
    {
        UserModel::destroy($id);
    }

    /**
     * @param array $details
     * @return mixed
     */
    public function create(array $details): mixed
    {
        return UserModel::create($details);
    }
}
