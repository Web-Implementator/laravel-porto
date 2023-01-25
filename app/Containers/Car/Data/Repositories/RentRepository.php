<?php

declare(strict_types=1);

namespace App\Containers\Car\Data\Repositories;

use App\Containers\Car\Contracts\RentRepositoryInterface;
use App\Containers\Car\Data\Transporters\RentUpdateDTO;
use App\Containers\Car\Data\Transporters\GetRentDTO;
use App\Containers\Car\Models\RentModel;
use App\Containers\Car\Resources\RentResource;

use App\Ship\Parents\Repositories\Repository;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

final class RentRepository extends Repository implements RentRepositoryInterface
{
    /**
     * @return AnonymousResourceCollection
     */
    public function getAll(): AnonymousResourceCollection
    {
        return RentResource::collection(RentModel::get());
    }

    /**
     * @param GetRentDTO $dto
     * @return RentResource
     */
    public function getByID(GetRentDTO $dto): RentResource
    {
        $id = $dto->id;

        if (!empty($dto->user_id)) {
            $query = RentModel::userId($dto->user_id)->findOrFail($id);
        } else if (!empty($dto->car_id)) {
            $query = RentModel::carId($dto->car_id)->findOrFail($id);
        } else {
            $query = RentModel::findOrFail($id);
        }

        return new RentResource($query);
    }

    /**
     * @param int $user_id
     * @return ?RentResource
     */
    public function get(int $user_id): ?RentResource
    {
        $query = RentModel::active()->userId($user_id)->first();

        if (!empty($query)) {
            return new RentResource($query);
        }

        return null;
    }

    /**
     * @param array $details
     * @return RentResource
     */
    public function create(array $details): RentResource
    {
        return new RentResource(RentModel::create($details));
    }

    /**
     * @param RentUpdateDTO $dto
     * @return RentResource
     */
    public function update(RentUpdateDTO $dto): RentResource
    {
        $model = RentModel::findOrFail($dto->id);

        $model->fill($dto->details);

        $model->save();

        return new RentResource($model);
    }

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id): void
    {
        RentModel::destroy($id);
    }
}
