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
use Carbon\Carbon;
use DB;

final class UnRentCarAction extends Action
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
            $rent = $this->rentRepository->getBy($dto);
            if (empty($rent)) {
                throw new RentException('У вас нет активной аренды');
            }

            $carDto = CarDTO::from([
               'carId' => $rent['car_id'],
            ]);

            $car = $this->carRepository->getBy($carDto);
            if ($car['status_id'] !== CarStatusEnum::busy->value) {
                throw new RentException('Не возможно отменить аренду у свободного автомобиля');
            }

            $this->rentRepository->update($dto->add([
                'rentId' => $rent->id,
                'endAt' => now(),
            ]));

            return $this->carRepository->update($carDto->add([
                'statusId' => CarStatusEnum::free->value
            ]));
        });
    }
}
