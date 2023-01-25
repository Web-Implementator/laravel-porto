<?php

declare(strict_types=1);

namespace App\Containers\Car\Resources;

use App\Ship\Parents\Resources\JsonResource;

use Illuminate\Http\Request,
    Carbon\Carbon;

final class CarResource extends JsonResource
{
    /**
     * Indicates if the resource's collection keys should be preserved.
     *
     * @var bool
     */
    public bool $preserveKeys = true;

    /**
     * Преобразовать ресурс в массив.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'is_active' => $this->is_active,
            'brand' => $this->brand,
            'model' => $this->model,
            'state_number' => $this->state_number,
            'status_id' => $this->status_id,
            'status_text' => $this->status_text,
            'created_at' => Carbon::parse($this->created_at)->format('d.m.Y H:i:s'),
            'updated_at' => Carbon::parse($this->updated_at)->format('d.m.Y H:i:s'),
        ];
    }
}
