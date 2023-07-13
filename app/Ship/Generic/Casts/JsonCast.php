<?php

namespace App\Ship\Generic\Casts;

use App\Ship\Parents\Casts\CastsAttributes;

use Illuminate\Database\Eloquent\Model;

class JsonCast extends CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param Model  $model
     * @param string $key
     * @param mixed  $value
     * @param array  $attributes
     * @return ?array
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): ?array
    {
        return json_decode($value, true);
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  Model  $model
     * @param  string $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return string
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): string
    {
        if (is_array($value)) {
            return json_encode($value);
        }

        if (is_string($value)) {
            return $value;
        }
    }
}
