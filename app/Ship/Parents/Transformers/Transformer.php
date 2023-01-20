<?php

declare(strict_types=1);

namespace App\Ship\Parents\Transformers;

use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\Primitive;
use League\Fractal\TransformerAbstract as FractalTransformer;

abstract class Transformer extends FractalTransformer
{
    /**
     * @param $data
     * @param $transformer
     * @param $resourceKey
     * @return Primitive|Item
     */
    public function nullableItem($data, $transformer, $resourceKey = null): Primitive|Item
    {
        if (is_null($data)) {
            return $this->primitive(null);
        }

        return $this->item($data, $transformer, $resourceKey = null);
    }

    /**
     * @param $data
     * @param $transformer
     * @param $resourceKey
     * @return Item
     */
    public function item($data, $transformer, $resourceKey = null): Item
    {
        // set a default resource key if none is set
        if (!$resourceKey && $data) {
            $resourceKey = $data->getResourceKey();
        }

        return parent::item($data, $transformer, $resourceKey);
    }

    /**
     * @param $data
     * @param $transformer
     * @param $resourceKey
     * @return Collection
     */
    public function collection($data, $transformer, $resourceKey = null): Collection
    {
        // set a default resource key if none is set
        if (!$resourceKey && $data->isNotEmpty()) {
            $resourceKey = (string)$data->modelKeys()[0];
        }

        return parent::collection($data, $transformer, $resourceKey);
    }
}
