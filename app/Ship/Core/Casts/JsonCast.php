<?php

declare(strict_types=1);

namespace App\Ship\Core\Casts;

use App\Ship\Abstracts\Casts\CastsAttributesAbstract;
use Exception;
use Illuminate\Database\Eloquent\Model;

final class JsonCast extends CastsAttributesAbstract
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
     * @param Model $model
     * @param string $key
     * @param mixed $value
     * @param array $attributes
     * @return string
     * @throws Exception
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): string
    {
        if (is_array($value)) {
            return json_encode($value);
        }

        if (is_string($value)) {
            return $value;
        }

        throw new Exception('Не известный тип');
    }
}
