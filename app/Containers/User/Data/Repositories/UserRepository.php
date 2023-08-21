<?php

declare(strict_types=1);

namespace App\Containers\User\Data\Repositories;

use App\Containers\User\Data\Transporters\UserDTO;
use App\Containers\User\Models\UserModel;
use App\Containers\User\Resources\UserCollection;
use App\Containers\User\Resources\UserResource;
use App\Ship\Abstracts\Repositories\Repository;

final class UserRepository extends Repository
{
    /**
     * @param UserDTO $dto
     * @return UserCollection
     */
    public function getAll(mixed $dto): UserCollection
    {
        return new UserCollection(UserModel::active()->get());
    }


    /**
     * @param UserDTO $dto
     * @return UserResource
     */
    public function getBy(mixed $dto): UserResource
    {
        return new UserResource(UserModel::active()->findOrFail($dto->getPrimaryId()));
    }

    /**
     * @param UserDTO $dto
     * @return UserResource
     */
    public function create(mixed $dto): UserResource
    {
        return new UserResource(UserModel::create($dto->toDataBase()));
    }

    /**
     * @param UserDTO $dto
     * @return UserResource
     */
    public function update(mixed $dto): UserResource
    {
        $model = UserModel::findOrFail($dto->getPrimaryId());

        $model->fill($dto->toDataBase());
        $model->save();

        return new UserResource($model);
    }

    /**
     * @param UserDTO $dto
     * @return void
     */
    public function delete(mixed $dto): void
    {
        UserModel::destroy($dto->getPrimaryId());
    }
}
