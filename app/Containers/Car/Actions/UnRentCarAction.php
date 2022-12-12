<?php

declare(strict_types=1);

namespace App\Containers\Car\Actions;

use App\Containers\Car\Data\Repositories\CarRepository;
use App\Containers\Car\Data\Repositories\RentRepository;
use App\Containers\Car\Data\Transporters\CarUpdateDTO;
use App\Containers\Car\Data\Transporters\GetCarDTO;
use App\Containers\Car\Data\Transporters\RentUpdateDTO;
use App\Containers\Car\Data\Transporters\UnRentCarDTO;
use App\Containers\Car\Data\Enums\CarStatusEnum;

use App\Ship\Parents\Actions\Action;

use Exception, Carbon\Carbon;

final class UnRentCarAction extends Action
{
    public function __construct(
        protected CarRepository $carRepository,
        protected RentRepository $rentRepository,
    ) {
    }

    /**
     * @param UnRentCarDTO $dto
     * @return array
     * @throws Exception
     */
    public function run(UnRentCarDTO $dto): array
    {
        $car = $this->carRepository->getByID(new GetCarDTO(id: $dto->car_id));

        if ($car['status'] !== CarStatusEnum::busy) {
            throw new Exception('Не возможно отменить аренду у свободного автомобиля');
        }

        $rent = $this->rentRepository->getActiveRent($dto->user_id);
        if (empty($rent)) {
            throw new Exception('У вас нет активной аренды');
        }

        $this->rentRepository->update(new RentUpdateDTO(id: $rent['id'], details: [ 'end_at' => Carbon::now() ]));

        return $this->carRepository->update(new CarUpdateDTO(id: $dto->car_id, details: [ 'status' => CarStatusEnum::free ]));
    }
}
