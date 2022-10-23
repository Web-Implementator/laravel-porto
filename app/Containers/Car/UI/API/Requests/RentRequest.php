<?php

declare(strict_types=1);

namespace App\Containers\Car\UI\API\Requests;

use App\Ship\Parents\Requests\Request;

final class RentRequest extends Request
{
    public function rules(): array
    {
        return [
            'car_id' => 'required|int',
            'user_id' => 'required|int',
        ];
    }
}
