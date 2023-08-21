<?php

declare(strict_types=1);

namespace App\Containers\Car\Listeners;

use App\Containers\Car\Data\Repositories\RentRepository;
use App\Containers\Car\Data\Transporters\RentDTO;
use App\Containers\Car\Events\CarCacheEvent;
use App\Ship\Abstracts\Listeners\ListenerAbstract;
use Psr\SimpleCache\InvalidArgumentException;

class RentCacheListener extends ListenerAbstract
{
    public function __construct(
        public RentRepository $repository,
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

        $rentId = $model->id;

        $rentDto = RentDTO::from(['isCache' => false]);

        // Cache all rents
        cache()->rememberForever('rent:all', function () use ($rentDto) {
            return $this->repository->getAll($rentDto);
        });

        // Cache current rent
        cache()->set("rent:$rentId", $this->repository->getBy($rentDto->add(['rentId' => $rentId])));
    }
}
