<?php

declare(strict_types=1);

namespace App\Containers\User\Data\Repositories;

use App\Containers\User\Models\UserModel;
use App\Containers\User\Resources\UserCollection;
use App\Containers\User\Resources\UserResource;
use App\Ship\Parents\Repositories\Repository;

final class UserRepository extends Repository
{
    /**
     * @return UserCollection
     */
    public function getAll(): UserCollection
    {
        return new UserCollection(UserModel::active()->get());
    }


    /**
     * @param string|int $id
     * @return UserResource
     */
    public function getById(string|int $id): UserResource
    {
        return new UserResource(UserModel::active()->findOrFail($id));
    }

    /**
     * @param array $data
     * @return UserResource
     */
    public function create(array $data): UserResource
    {
        return new UserResource(UserModel::create($data));
    }

    /**
     * @param string|int $id
     * @param array $data
     * @return UserResource
     */
    public function update(string|int $id, array $data): UserResource
    {
        $model = UserModel::findOrFail($id);

        $model->fill($data);
        $model->save();

        return new UserResource($model);
    }

    /**
     * @param string|int $id
     * @return void
     */
    public function delete(string|int $id): void
    {
        UserModel::destroy($id);
    }
}
