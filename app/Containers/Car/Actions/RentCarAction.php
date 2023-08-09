<?php

declare(strict_types=1);

namespace App\Containers\Car\Actions;

use App\Containers\Car\Data\Repositories\CarRepository;
use App\Containers\Car\Data\Repositories\RentRepository;
use App\Containers\Car\Data\Enums\CarStatusEnum;
use App\Containers\Car\Data\Transporters\RentCarDTO;
use App\Containers\Car\Resources\CarResource;
use App\Ship\Core\Exceptions\RentException;
use App\Ship\Abstracts\Actions\Action;
use Carbon\Carbon, Exception, DB;

final class RentCarAction extends Action
{
    public function __construct(
        protected CarRepository $carRepository,
        protected RentRepository $rentRepository,
    ) {
    }

    /**
     * @param RentCarDTO $dto
     * @return CarResource
     * @throws Exception
     */
    public function run(RentCarDTO $dto): CarResource
    {
        return DB::transaction(function () use ($dto) {
            $carId = $dto->getPrimaryId();
            $userId = $dto->userId;

            $car = $this->carRepository->getByID($carId);

            if ($car['status_id'] !== CarStatusEnum::free->value) {
                throw new RentException('Автомобиль уже арендуют');
            }

            $rent = $this->rentRepository->getByUserId($userId);
            if (!empty($rent)) {
                if ($rent['car_id'] !== $carId) {
                    throw new RentException('Вы уже взяли другой автомобиль в аренду');
                }

                throw new RentException('Вы уже арендуете этот автомобиль');
            }

            $this->rentRepository->create([
                'car_id' => $carId,
                'user_id' => $userId,
                'begin_at' => Carbon::now()
            ]);

            return $this->carRepository->update($carId, [
                'status_id' => CarStatusEnum::busy->value
            ]);
        });
    }
}
