<?php

declare(strict_types=1);

namespace App\Containers\User\UI\API\Transformers;

use League\Fractal\TransformerAbstract;

final class GetUsersTransformer extends TransformerAbstract
{
    /**
     * @param array $response
     * @return array
     */
    public function transform(array $response): array
    {
        return collect($response)->map(function ($item) {
            return app(GetUserTransformer::class)->transform($item);
        })->toArray();
    }
}
