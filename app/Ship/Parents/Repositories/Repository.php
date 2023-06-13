<?php

declare(strict_types=1);

namespace App\Ship\Parents\Repositories;

abstract class Repository
{
    /**
     * @return mixed
     */
    abstract public function getAll(): mixed;

    /**
     * @param string|int $id
     * @return mixed
     */
    abstract public function getByID(string|int $id): mixed;

    /**
     * @param array $data
     * @return mixed
     */
    abstract public function create(array $data): mixed;

    /**
     * @param string|int $id
     * @param array $data
     * @return mixed
     */
    abstract public function update(string|int $id, array $data): mixed;

    /**
     * @param string|int $id
     * @return void
     */
    abstract public function delete(string|int $id): void;
}
