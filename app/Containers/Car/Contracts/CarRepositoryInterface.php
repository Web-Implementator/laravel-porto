<?php

declare(strict_types=1);

namespace App\Containers\Car\Contracts;

use App\Containers\Car\Data\Transporters\CarUpdateDTO;
use App\Containers\Car\Data\Transporters\GetCarDTO;

interface CarRepositoryInterface
{
    /**
     * @return array
     */
    public function getAll(): array;

    /**
     * @param GetCarDTO $dto
     * @return array
     */
    public function getByID(GetCarDTO $dto): array;

    /**
     * @param CarUpdateDTO $dto
     * @return array
     */
    public function update(CarUpdateDTO $dto): array;

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
