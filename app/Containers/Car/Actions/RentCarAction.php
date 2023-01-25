<?php

declare(strict_types=1);

namespace App\Containers\Car\Actions;

use App\Containers\Car\Data\Repositories\CarRepository;
use App\Containers\Car\Data\Repositories\RentRepository;
use App\Containers\Car\Data\Transporters\CarUpdateDTO;
use App\Containers\Car\Data\Transporters\GetCarDTO;
use App\Containers\Car\Data\Transporters\RentCarDTO;
use App\Containers\Car\Data\Enums\CarStatusEnum;

use App\Containers\Car\Resources\CarResource;

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
     * @return CarResource
     * @throws Exception
     */
    public function run(RentCarDTO $dto): CarResource
    {
        $car_id = $dto->car_id;
        $user_id = $dto->user_id;

        $car = $this->carRepository->getByID(new GetCarDTO(id: $car_id));

        if ($car['status_id'] !== CarStatusEnum::free->value) {
            throw new Exception('Автомобиль уже арендуют');
        }

        $rent = $this->rentRepository->get($user_id);
        if (!empty($rent)) {
            if ($rent['car_id'] !== $car_id) {
                throw new Exception('Вы уже взяли другой автомобиль в аренду');
            }

            throw new Exception('Вы уже арендуете этот автомобиль');
        }

        $this->rentRepository->create([
            'car_id' => $car_id,
            'user_id' => $user_id,
            'begin_at' => Carbon::now()
        ]);

        return $this->carRepository->update(new CarUpdateDTO(id: $car_id, details: [ 'status_id' => CarStatusEnum::busy->value ]));
    }
}
