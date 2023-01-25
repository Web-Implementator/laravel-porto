<?php

declare(strict_types=1);

namespace App\Containers\Car\Resources;

use App\Ship\Parents\Resources\JsonResource;

use Illuminate\Http\Request,
    Carbon\Carbon;

final class RentResource extends JsonResource
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
            'car' => $this->car,
            'user_id' => $this->user,
            'begin_at' => Carbon::parse($this->begin_at)->format('d.m.Y H:i:s'),
            'end_at' => Carbon::parse($this->end_at)->format('d.m.Y H:i:s'),
            'created_at' => Carbon::parse($this->created_at)->format('d.m.Y H:i:s'),
            'updated_at' => Carbon::parse($this->updated_at)->format('d.m.Y H:i:s'),
        ];
    }
}
