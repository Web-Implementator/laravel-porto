<?php

declare(strict_types=1);

namespace App\Containers\Car\Listeners;

use App\Containers\Car\Data\Repositories\CarRepository;
use App\Containers\Car\Data\Transporters\CarDTO;
use App\Containers\Car\Events\CarCacheEvent;
use App\Ship\Abstracts\Listeners\ListenerAbstract;
use Psr\SimpleCache\InvalidArgumentException;

class CarCacheListener extends ListenerAbstract
{
    public function __construct(
      public CarRepository $repository,
    ) {
    }

    /**
     * @param CarCacheEvent $event
     * @return void
     * @throws InvalidArgumentException
     */
    public function handle(mixed $event): void
    {
        $model = $event->model;

        $carId = $model->id;

        $carDto = CarDTO::from(['isCache' => false]);

        // Cache all cars
        cache()->rememberForever('car:all', function () use ($carDto) {
            return $this->repository->getAll($carDto);
        });

        // Cache current car
        cache()->set("car:$carId", $this->repository->getBy($carDto->add(['carId' => $carId])));
    }
}
