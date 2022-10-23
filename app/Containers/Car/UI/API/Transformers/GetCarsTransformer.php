<?php

declare(strict_types=1);

namespace App\Containers\Car\UI\API\Transformers;

use League\Fractal\TransformerAbstract;

final class GetCarsTransformer extends TransformerAbstract
{
    /**
     * @param array $response
     * @return array
     */
    public function transform(array $response): array
    {
        return collect($response)->map(function ($item) {
            return app(GetCarTransformer::class)->transform($item);
        })->toArray();
    }
}
