<?php

declare(strict_types=1);

namespace App\Containers\Car\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

use Illuminate\Http\Request;

final class RentCollection extends ResourceCollection
{
    /**
     * Ресурс, используемый при формировании коллекции.
     *
     * @var string
     */
    public $collects = RentResource::class;

    /**
     * Преобразовать ресурс в массив.
     *
     * @param Request $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection
        ];
    }
}
