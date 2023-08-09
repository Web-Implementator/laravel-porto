<?php

declare(strict_types=1);

namespace App\Containers\Car\Data\Repositories;

use App\Containers\Car\Models\CarModelAbstract;
use App\Containers\Car\Resources\CarCollection;
use App\Containers\Car\Resources\CarResource;
use App\Ship\Abstracts\Repositories\Repository;

final class CarRepository extends Repository
{
    /**
     * @return CarCollection
     */
    public function getAll(): CarCollection
    {
        return new CarCollection(CarModelAbstract::active()->get());
    }

    /**
     * @param int|string $id
     * @return CarResource
     */
    public function getByID(int|string $id): CarResource
    {
        return new CarResource(CarModelAbstract::active()->findOrFail($id));
    }

    /**
     * @param array $data
     * @return CarResource
     */
    public function create(array $data): CarResource
    {
        return new CarResource(CarModelAbstract::create($data));
    }

    /**
     * @param int|string $id
     * @param array $data
     * @return CarResource
     */
    public function update(int|string $id, array $data): CarResource
    {
        $model = CarModelAbstract::findOrFail($id);

        $model->fill($data);

        $model->save();

        return new CarResource($model);
    }

    /**
     * @param int|string $id
     * @return void
     */
    public function delete(int|string $id): void
    {
        CarModelAbstract::destroy($id);
    }
}
