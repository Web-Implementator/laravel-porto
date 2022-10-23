<?php

declare(strict_types=1);

namespace App\Containers\User\Contracts;

use App\Containers\User\Data\Transporters\UserUpdateDTO;
use App\Containers\User\Data\Transporters\GetUserDTO;

interface UserRepositoryInterface
{
    /**
     * @return array
     */
    public function getAll(): array;

    /**
     * @param GetUserDTO $dto
     * @return array
     */
    public function getById(GetUserDTO $dto): array;

    /**
     * @param UserUpdateDTO $dto
     * @return array
     */
    public function update(UserUpdateDTO $dto): array;

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id): void;

    /**
     * @param array $details
     * @return mixed
     */
    public function create(array $details): mixed;
}
