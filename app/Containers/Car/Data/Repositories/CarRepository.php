<?php

declare(strict_types=1);

namespace App\Containers\Car\Data\Repositories;

use App\Containers\Car\Contracts\CarRepositoryInterface;
use App\Containers\Car\Data\Transporters\CarUpdateDTO;
use App\Containers\Car\Data\Transporters\GetCarDTO;
use App\Containers\Car\Models\CarModel;

use App\Ship\Parents\Repositories\Repository;

final class CarRepository extends Repository implements CarRepositoryInterface
{
    /**
     * @return array
     */
    public function getAll(): array
    {
        return CarModel::active()->get()->toArray();
    }

    /**
     * @param GetCarDTO $dto
     * @return array
     */
    public function getByID(GetCarDTO $dto): array
    {
        return CarModel::active()->findOrFail($dto->id)->toArray();
    }

    /**
     * @param CarUpdateDTO $dto
     * @return array
     */
    public function update(CarUpdateDTO $dto): array
    {
        $model = CarModel::findOrFail($dto->id);

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
        CarModel::destroy($id);
    }

    /**
     * @param array $details
     * @return mixed
     */
    public function create(array $details): mixed
    {
        return CarModel::create($details);
    }
}
