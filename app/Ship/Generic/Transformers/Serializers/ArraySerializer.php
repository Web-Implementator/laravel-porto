<?php

declare(strict_types=1);

namespace App\Ship\Generic\Transformers\Serializers;

use League\Fractal\Serializer\ArraySerializer as FractalArraySerializer;

final class ArraySerializer extends FractalArraySerializer
{
    /**
     * Serialize a collection.
     *
     * @param string $resourceKey
     * @param array $data
     *
     * @return array
     */
    public function collection($resourceKey, array $data): array
    {
        return $data;
    }
}
