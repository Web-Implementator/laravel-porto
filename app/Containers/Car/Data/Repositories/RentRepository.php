<?php

declare(strict_types=1);

namespace App\Containers\Car\Data\Repositories;

use App\Containers\Car\Models\RentModel;
use App\Containers\Car\Resources\RentCollection;
use App\Containers\Car\Resources\RentResource;
use App\Ship\Parents\Repositories\Repository;

final class RentRepository extends Repository
{
    /**
     * @return RentCollection
     */
    public function getAll(): RentCollection
    {
        return new RentCollection(RentModel::get());
    }

    /**
     * @param int|string $id
     * @return RentResource
     */
    public function getByID(int|string $id): RentResource
    {
        return new RentResource(RentModel::findOrFail($id));
    }

    /**
     * @param int $car_id
     * @return RentResource|null
     */
    public function getByCarId(int $car_id): ?RentResource
    {
        $query = RentModel::active()->carId($car_id)->first();

        if (!empty($query)) {
            return new RentResource($query);
        }

        return null;
    }

    /**
     * @param int $user_id
     * @return ?RentResource
     */
    public function getByUserId(int $user_id): ?RentResource
    {
        $query = RentModel::active()->userId($user_id)->first();

        if (!empty($query)) {
            return new RentResource($query);
        }

        return null;
    }

    /**
     * @param array $data
     * @return RentResource
     */
    public function create(array $data): RentResource
    {
        return new RentResource(RentModel::create($data));
    }

    /**
     * @param int|string $id
     * @param array $data
     * @return RentResource
     */
    public function update(int|string $id, array $data): RentResource
    {
        $model = RentModel::findOrFail($id);

        $model->fill($data);

        $model->save();

        return new RentResource($model);
    }

    /**
     * @param int|string $id
     * @return void
     */
    public function delete(int|string $id): void
    {
        RentModel::destroy($id);
    }
}
