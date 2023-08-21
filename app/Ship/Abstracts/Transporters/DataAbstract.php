<?php

declare(strict_types=1);

namespace App\Ship\Abstracts\Transporters;

use Illuminate\Support\Arr;
use Spatie\LaravelData\Data as SpatieData;

abstract class DataAbstract extends SpatieData
{
    /**
     * @return array
     */
    public function toDataBase(): array
    {
        $filtered = $this->toArrayNotNull();

        $response = [];
        foreach ($filtered as $key => $value) {
            $response[mb_strtolower(preg_replace('/(?!^)[[:upper:]]/','_\0', $key))] = $value;
        }

        return $response;
    }

    /**
     * @return array
     */
    public function toArrayNotNull(): array
    {
        return Arr::whereNotNull(parent::toArray());
    }

    /**
     * @param array $props
     * @return mixed
     */
    public function add(array $props): mixed
    {
        foreach ($props as $key => $value) {
            $this->{$key} = $value;
        }

        return $this;
    }

    /**
     * @return mixed
     */
    abstract public function getPrimaryId(): mixed;
}
