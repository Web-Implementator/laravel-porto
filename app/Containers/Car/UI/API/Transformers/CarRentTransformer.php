<?php

declare(strict_types=1);

namespace App\Containers\Car\UI\API\Transformers;

use League\Fractal\TransformerAbstract;

final class CarRentTransformer extends TransformerAbstract
{
    /**
     * @param array $response
     * @return array
     */
    public function transform(array $response): array
    {
        return [
            'id' => $response['id'],
            'message' => [
                'type' => 'success',
                'text' => 'Автомобиль успешно взят в аренду'
            ]
        ];
    }
}
