<?php

declare(strict_types=1);

namespace App\Containers\Car\Actions;

use App\Containers\Car\Data\Enums\CarStatusEnum;
use App\Containers\Car\Data\Repositories\CarRepository;
use App\Containers\Car\Data\Repositories\RentRepository;
use App\Containers\Car\Data\Transporters\CarDTO;
use App\Containers\Car\Data\Transporters\RentDTO;
use App\Containers\Car\Resources\CarResource;
use App\Ship\Abstracts\Actions\Action;
use App\Ship\Core\Exceptions\RentException;
use DB;

final class RentCarAction extends Action
{
    /**
     * @param CarRepository $carRepository
     * @param RentRepository $rentRepository
     */
    public function __construct(
        protected CarRepository $carRepository,
        protected RentRepository $rentRepository,
    ) {
    }

    /**
     * @param RentDTO $dto
     * @return CarResource
     * @throws RentException
     */
    public function run(RentDTO $dto): CarResource
    {
        return DB::transaction(function () use ($dto) {
            $carId = $dto->carId;

            $carDto = CarDTO::from([
                'carId' => $carId
            ]);

            $car = $this->carRepository->getBy($carDto);

            if ($car['status_id'] !== CarStatusEnum::free->value) {
                throw new RentException('Автомобиль уже арендуют');
            }

            $rent = $this->rentRepository->getBy($dto);
            if (! empty($rent)) {
                if ($rent['car_id'] !== $carId) {
                    throw new RentException('Вы уже взяли другой автомобиль в аренду');
                }

                throw new RentException('Вы уже арендуете этот автомобиль');
            }

            $this->rentRepository->create($dto);

            return $this->carRepository->update($carDto->add([
                'statusId' => CarStatusEnum::busy->value
            ]));
        });
    }
}
