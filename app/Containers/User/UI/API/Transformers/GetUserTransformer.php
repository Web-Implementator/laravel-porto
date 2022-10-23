<?php

declare(strict_types=1);

namespace App\Containers\User\UI\API\Transformers;

use League\Fractal\TransformerAbstract;

final class GetUserTransformer extends TransformerAbstract
{
    /**
     * @param array $response
     * @return array
     */
    public function transform(array $response): array
    {
        return [
            'id' => $response['id'],
            'is_active' => (bool) $response['is_active'],
            'name' => $response['name'],
            'email' => $response['email'],
        ];
    }
}
