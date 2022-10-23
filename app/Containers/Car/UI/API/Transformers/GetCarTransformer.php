<?php

declare(strict_types=1);

namespace App\Containers\Car\UI\API\Transformers;

use League\Fractal\TransformerAbstract;

final class GetCarTransformer extends TransformerAbstract
{
    /**
     * @param array $response
     * @return array
     */
    public function transform(array $response): array
    {
        $status_id = $response['status'];
        $status_text = match ($status_id) {
           1 => 'Свободна',
           2 => 'Занята'
        };

        return [
            'id' => $response['id'],
            'is_active' => (bool) $response['is_active'],
            'brand' => $response['brand'],
            'model' => $response['model'],
            'state_number' => $response['state_number'],
            'status_id' => $status_id,
            'status_text' => $status_text,
        ];
    }
}
