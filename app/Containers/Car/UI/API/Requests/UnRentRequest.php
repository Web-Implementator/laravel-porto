<?php

declare(strict_types=1);

namespace App\Containers\Car\UI\API\Requests;

use App\Ship\Parents\Requests\RequestApi;

final class UnRentRequest extends RequestApi
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'userId' => 'required|int',
        ];
    }
}
