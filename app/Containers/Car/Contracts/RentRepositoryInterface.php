<?php

declare(strict_types=1);

namespace App\Containers\Car\Contracts;

use App\Containers\Car\Data\Transporters\GetRentDTO;
use App\Containers\Car\Data\Transporters\RentUpdateDTO;

use App\Containers\Car\Resources\RentResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

interface RentRepositoryInterface
{
    /**
     * @return AnonymousResourceCollection
     */
    public function getAll(): AnonymousResourceCollection;

    /**
     * @param GetRentDTO $dto
     * @return RentResource
     */
    public function getByID(GetRentDTO $dto): RentResource;

    /**
     * @param int $user_id
     * @return ?RentResource
     */
    public function get(int $user_id): ?RentResource;

    /**
     * @param array $details
     * @return RentResource
     */
    public function create(array $details): RentResource;

    /**
     * @param RentUpdateDTO $dto
     * @return RentResource
     */
    public function update(RentUpdateDTO $dto): RentResource;

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id): void;
}
