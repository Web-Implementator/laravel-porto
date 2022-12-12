<?php

declare(strict_types=1);

namespace App\Containers\Car\Actions;

use App\Containers\Car\Data\Repositories\CarRepository;
use App\Containers\Car\Data\Repositories\RentRepository;
use App\Containers\Car\Data\Transporters\CarUpdateDTO;
use App\Containers\Car\Data\Transporters\GetCarDTO;
use App\Containers\Car\Data\Transporters\RentCarDTO;
use App\Containers\Car\Data\Enums\CarStatusEnum;

use App\Ship\Parents\Actions\Action;

use Carbon\Carbon, Exception;

final class RentCarAction extends Action
{
    public function __construct(
        protected CarRepository $carRepository,
        protected RentRepository $rentRepository,
    ) {
    }

    /**
     * @param RentCarDTO $dto
     * @return array
     * @throws Exception
     */
    public function run(RentCarDTO $dto): array
    {
        $car = $this->carRepository->getByID(new GetCarDTO(id: $dto->car_id));

        if ($car['status'] !== CarStatusEnum::free->value) {
            throw new Exception('Автомобиль уже арендуют');
        }

        $rent = $this->rentRepository->getActiveRent($dto->user_id);
        if (!empty($rent)) {
            throw new Exception('Вы уже взяли другой автомобиль в аренду');
        }

        $this->rentRepository->create([
            'car_id' => $dto->car_id,
            'user_id' => $dto->user_id,
            'begin_at' => Carbon::now()
        ]);

        return $this->carRepository->update(new CarUpdateDTO(id: $dto->car_id, details: [ 'status' => CarStatusEnum::busy->value ]));
    }
}
