<?php

declare(strict_types=1);

namespace App\Containers\User\Contracts;

use App\Containers\User\Data\Transporters\UserUpdateDTO;
use App\Containers\User\Data\Transporters\GetUserDTO;
use App\Containers\User\Resources\UserResource;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

interface UserRepositoryInterface
{
    /**
     * @return AnonymousResourceCollection
     */
    public function getAll(): AnonymousResourceCollection;

    /**
     * @param GetUserDTO $dto
     * @return UserResource
     */
    public function getById(GetUserDTO $dto): UserResource;

    /**
     * @param array $details
     * @return UserResource
     */
    public function create(array $details): UserResource;

    /**
     * @param UserUpdateDTO $dto
     * @return UserResource
     */
    public function update(UserUpdateDTO $dto): UserResource;

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;
}
