<?php

declare(strict_types=1);

namespace App\Containers\Car\Data\Repositories;

use App\Containers\Car\Data\Transporters\CarDTO;
use App\Containers\Car\Models\CarModel;
use App\Containers\Car\Resources\CarCollection;
use App\Containers\Car\Resources\CarResource;
use App\Ship\Abstracts\Repositories\Repository;

final class CarRepository extends Repository
{
    /**
     * @param CarDTO $dto
     * @return CarCollection
     */
    public function getAll(mixed $dto): CarCollection
    {
        $isCache = $dto->isCache;

        if ($isCache === true) {
            $collection = $this->getCache('car:all');
        }

        $collection =  $collection ?? CarModel::active()->get();

        return new CarCollection($collection);
    }

    /**
     * @param CarDTO $dto
     * @return CarResource
     */
    public function getBy(mixed $dto): CarResource
    {
        $carId = $dto->getPrimaryId();

        $isCache = $dto->isCache;

        if ($isCache === true) {
            $collection = $this->getCache("car:$carId");
        }

        $collection = $collection ?? CarModel::findOrFail($carId);

        return new CarResource($collection);
    }

    /**
     * @param CarDTO $dto
     * @return CarResource
     */
    public function create(mixed $dto): CarResource
    {
        return new CarResource(CarModel::create($dto->toDataBase()));
    }

    /**
     * @param CarDTO $dto
     * @return CarResource
     */
    public function update(mixed $dto): CarResource
    {
        $model = CarModel::findOrFail($dto->getPrimaryId());

        $model->fill($dto->toDataBase());

        $model->save();

        return new CarResource($model);
    }

    /**
     * @param CarDTO $dto
     * @return void
     */
    public function delete(mixed $dto): void
    {
        CarModel::destroy($dto->getPrimaryId());
    }
}
