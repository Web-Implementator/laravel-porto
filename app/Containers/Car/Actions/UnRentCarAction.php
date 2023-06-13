<?php

declare(strict_types=1);

namespace App\Containers\Car\Actions;

use App\Containers\Car\Data\Repositories\CarRepository;
use App\Containers\Car\Data\Repositories\RentRepository;
use App\Containers\Car\Data\Enums\CarStatusEnum;
use App\Containers\Car\Data\Transporters\UnRentCarDTO;
use App\Containers\Car\Resources\CarResource;
use App\Ship\Generic\Exceptions\RentException;
use App\Ship\Parents\Actions\Action;
use Exception, Carbon\Carbon, DB;

final class UnRentCarAction extends Action
{
    public function __construct(
        protected CarRepository $carRepository,
        protected RentRepository $rentRepository,
    ) {
    }

    /**
     * @param UnRentCarDTO $dto
     * @return CarResource
     * @throws Exception
     */
    public function run(UnRentCarDTO $dto): CarResource
    {
        return DB::transaction(function () use ($dto) {
            $userId = $dto->userId;

            $rent = $this->rentRepository->getByUserId($userId);
            if (empty($rent)) {
                throw new RentException('У вас нет активной аренды');
            }

            $carId = $rent['car_id'];

            $car = $this->carRepository->getByID($carId);

            $this->rentRepository->update($rent['id'], [
                'end_at' => Carbon::now()
            ]);

            if ($car['status_id'] !== CarStatusEnum::busy->value) {
                throw new RentException('Не возможно отменить аренду у свободного автомобиля');
            }

            return $this->carRepository->update($carId, [
                'status_id' => CarStatusEnum::free->value
            ]);
        });
    }
}
