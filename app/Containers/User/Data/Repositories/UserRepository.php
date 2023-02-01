<?php

declare(strict_types=1);

namespace App\Containers\User\Data\Repositories;

use App\Containers\User\Contracts\UserRepositoryInterface;
use App\Containers\User\Data\Transporters\GetUserDTO;
use App\Containers\User\Data\Transporters\UserUpdateDTO;
use App\Containers\User\Models\UserModel;
use App\Containers\User\Resources\UserResource;
use App\Ship\Parents\Repositories\Repository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

final class UserRepository extends Repository implements UserRepositoryInterface
{
    /**
     * @return AnonymousResourceCollection
     */
    public function getAll(): AnonymousResourceCollection
    {
        return UserResource::collection(UserModel::active()->get());
    }


    /**
     * @param GetUserDTO $dto
     * @return UserResource
     */
    public function getById(GetUserDTO $dto): UserResource
    {
        return new UserResource(UserModel::active()->findOrFail($dto->id));
    }

    /**
     * @param GetUserDTO $dto
     * @return UserResource
     */
    public function getBy(GetUserDTO $dto): UserResource
    {
        $query = UserModel::active();

        $email = $dto->email ?? null;
        if (!empty($email)) {
            $query->email($email);
        }

        return new UserResource($query->firstOrFail());
    }

    /**
     * @param array $details
     * @return UserResource
     */
    public function create(array $details): UserResource
    {
        $details['password'] = Hash::make($details['password']);

        return new UserResource(UserModel::create($details));
    }

    /**
     * @param UserUpdateDTO $dto
     * @return UserResource
     */
    public function update(UserUpdateDTO $dto): UserResource
    {
        $model = UserModel::findOrFail($dto->id);

        $model->fill($dto->details);
        $model->save();

        return new UserResource($model);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        UserModel::destroy($id);

        return true;
    }
}
