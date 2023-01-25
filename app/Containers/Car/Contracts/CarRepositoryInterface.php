<?php

declare(strict_types=1);

namespace App\Containers\Car\Contracts;

use App\Containers\Car\Data\Transporters\CarUpdateDTO;
use App\Containers\Car\Data\Transporters\GetCarDTO;
use App\Containers\Car\Resources\CarResource;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

interface CarRepositoryInterface
{
    /**
     * @return AnonymousResourceCollection
     */
    public function getAll(): AnonymousResourceCollection;

    /**
     * @param GetCarDTO $dto
     * @return CarResource
     */
    public function getByID(GetCarDTO $dto): CarResource;

    /**
     * @param array $details
     * @return CarResource
     */
    public function create(array $details): CarResource;

    /**
     * @param CarUpdateDTO $dto
     * @return CarResource
     */
    public function update(CarUpdateDTO $dto): CarResource;

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id): void;
}
