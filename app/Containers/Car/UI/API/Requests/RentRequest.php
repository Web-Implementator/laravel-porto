<?php

declare(strict_types=1);

namespace App\Containers\Car\UI\API\Requests;

use App\Ship\Parents\Requests\RequestApi;

final class RentRequest extends RequestApi
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'car_id' => 'required|int',
            'user_id' => 'required|int',
        ];
    }
}
