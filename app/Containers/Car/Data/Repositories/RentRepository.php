<?php

declare(strict_types=1);

namespace App\Containers\Car\Data\Repositories;

use App\Containers\Car\Contracts\RentRepositoryInterface;
use App\Containers\Car\Data\Transporters\RentUpdateDTO;
use App\Containers\Car\Data\Transporters\GetCarDTO;
use App\Containers\Car\Data\Transporters\GetRentDTO;
use App\Containers\Car\Models\RentModel;

use App\Ship\Parents\Repositories\Repository;

final class RentRepository extends Repository implements RentRepositoryInterface
{
    /**
     * @return array
     */
    public function getAll(): array
    {
        return RentModel::get()->toArray();
    }

    /**
     * @param GetRentDTO $dto
     * @return array
     */
    public function getByID(GetRentDTO $dto): array
    {
        if (!empty($dto->user_id)) {
            return RentModel::userId($dto->user_id)->findOrFail($dto->id)->toArray();
        } else if (!empty($dto->car_id)) {
            return RentModel::carId($dto->car_id)->findOrFail($dto->id)->toArray();
        } else {
            return RentModel::findOrFail($dto->id)->toArray();
        }
    }

    /**
     * @param int $user_id
     * @return ?array
     */
    public function getActiveRent(int $user_id): ?array
    {
        $query = RentModel::active()->userId($user_id)->first();

        if (!empty($query)) {
            return $query->toArray();
        }

        return null;
    }

    /**
     * @param RentUpdateDTO $dto
     * @return array
     */
    public function update(RentUpdateDTO $dto): array
    {
        $model = RentModel::findOrFail($dto->id);

        $model->fill($dto->details);

        $model->save();

        return $model->toArray();
    }

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id): void
    {
        RentModel::destroy($id);
    }

    /**
     * @param array $details
     * @return mixed
     */
    public function create(array $details): mixed
    {
        return RentModel::create($details);
    }
}
