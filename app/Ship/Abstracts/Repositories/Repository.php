<?php

declare(strict_types=1);

namespace App\Ship\Abstracts\Repositories;

use App\Containers\Car\Data\Transporters\CarDTO;
use Throwable;

abstract class Repository
{
    /**
     * @param mixed $dto
     * @return mixed
     */
    abstract public function getAll(mixed $dto): mixed;

    /**
     * @param mixed $dto
     * @return mixed
     */
    abstract public function getBy(mixed $dto): mixed;

    /**
     * @param mixed $dto
     * @return mixed
     */
    abstract public function create(mixed $dto): mixed;

    /**
     * @param mixed $dto
     * @return mixed
     */
    abstract public function update(mixed $dto): mixed;

    /**
     * @param mixed $dto
     * @return void
     */
    abstract public function delete(mixed $dto): void;

    /**
     * @param string $key
     * @return mixed
     */
    public function getCache(string $key): mixed
    {
        try {
            if (cache()->has($key)) {
                $cache = cache()->get($key);

                return !empty($cache) && is_string($cache) ? json_decode($cache) : $cache;
            }

        } catch (Throwable $exc) {

        }

        return  null;
    }
}
