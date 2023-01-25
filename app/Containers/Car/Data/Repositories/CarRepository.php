<?php

declare(strict_types=1);

namespace App\Containers\Car\Data\Repositories;

use App\Containers\Car\Contracts\CarRepositoryInterface;
use App\Containers\Car\Data\Transporters\CarUpdateDTO;
use App\Containers\Car\Data\Transporters\GetCarDTO;
use App\Containers\Car\Models\CarModel;
use App\Containers\Car\Resources\CarResource;

use App\Ship\Parents\Repositories\Repository;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

final class CarRepository extends Repository implements CarRepositoryInterface
{
    /**
     * @return AnonymousResourceCollection
     */
    public function getAll(): AnonymousResourceCollection
    {
        return CarResource::collection(CarModel::active()->get());
    }

    /**
     * @param GetCarDTO $dto
     * @return CarResource
     */
    public function getByID(GetCarDTO $dto): CarResource
    {
        return new CarResource(CarModel::active()->findOrFail($dto->id));
    }

    /**
     * @param array $details
     * @return CarResource
     */
    public function create(array $details): CarResource
    {
        return new CarResource(CarModel::create($details));
    }

    /**
     * @param CarUpdateDTO $dto
     * @return CarResource
     */
    public function update(CarUpdateDTO $dto): CarResource
    {
        $model = CarModel::findOrFail($dto->id);

        $model->fill($dto->details);

        $model->save();

        return new CarResource($model);
    }

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id): void
    {
        CarModel::destroy($id);
    }
}
