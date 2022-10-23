<?php

declare(strict_types=1);

namespace App\Containers\Car\Contracts;

use App\Containers\Car\Data\Transporters\GetRentDTO;
use App\Containers\Car\Data\Transporters\RentUpdateDTO;

interface RentRepositoryInterface
{
    /**
     * @return array
     */
    public function getAll(): array;

    /**
     * @param GetRentDTO $dto
     * @return array
     */
    public function getByID(GetRentDTO $dto): array;

    /**
     * @param int $user_id
     * @return ?array
     */
    public function getActiveRent(int $user_id): ?array;

    /**
     * @param RentUpdateDTO $dto
     * @return array
     */
    public function update(RentUpdateDTO $dto): array;

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
