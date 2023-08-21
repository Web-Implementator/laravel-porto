<?php

declare(strict_types=1);

namespace App\Containers\Car\Data\Repositories;

use App\Containers\Car\Data\Transporters\RentDTO;
use App\Containers\Car\Models\RentModel;
use App\Containers\Car\Resources\RentCollection;
use App\Containers\Car\Resources\RentResource;
use App\Ship\Abstracts\Repositories\Repository;

final class RentRepository extends Repository
{
    /**
     * @param RentDTO $dto
     * @return RentCollection
     */
    public function getAll(mixed $dto): RentCollection
    {
        $isCache = $dto->isCache;

        if ($isCache === true) {
            $collection = $this->getCache('rent:all');
        }

        $collection =  $collection ?? RentModel::get();

        return new RentCollection($collection);
    }

    /**
     * @param RentDTO $dto
     * @return RentResource
     */
    public function getByID(mixed $dto): RentResource
    {
        $rentId = $dto->getPrimaryId();
        $isCache = $dto->isCache;

        if ($isCache === true) {
            $collection = $this->getCache("rent:$rentId");
        }

        $collection = $collection ?? RentModel::findOrFail($rentId);

        return new RentResource($collection);
    }

    /**
     * @param RentDTO $dto
     * @return ?RentResource
     */
    public function getBy(mixed $dto): ?RentResource
    {
        $rentId = $dto->getPrimaryId();
        if (!empty($rentId)) {
            $entity = $dto->isCache === true ? $this->getCache("rent:$rentId") : RentModel::findOrFail($rentId);
        } else {
            $query = RentModel::query()->active();

            $carId = $dto->carId;
            if (!empty($carId)) {
                $query->carId($carId);
            }

            $userId = $dto->userId;
            if (!empty($userId)) {
                $query->userId($userId);
            }

            $entity = $query->first();
        }

        if (!empty($entity)) {
            return new RentResource($entity);
        }

        return null;
    }

    /**
     * @param RentDTO $dto
     * @return RentResource
     */
    public function create(mixed $dto): RentResource
    {
        return new RentResource(RentModel::create($dto->toDataBase()));
    }

    /**
     * @param RentDTO $dto
     * @return RentResource
     */
    public function update(mixed $dto): RentResource
    {
        $model = RentModel::findOrFail($dto->getPrimaryId());

        $model->fill($dto->toDataBase());

        $model->save();

        return new RentResource($model);
    }

    /**
     * @param RentDTO $dto
     * @return void
     */
    public function delete(mixed $dto): void
    {
        RentModel::destroy($dto->getPrimaryId());
    }
}
