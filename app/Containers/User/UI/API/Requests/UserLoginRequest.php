<?php

declare(strict_types=1);

namespace App\Containers\User\UI\API\Requests;

use App\Ship\Parents\Requests\RequestApi;

final class UserLoginRequest extends RequestApi
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'email' => 'required|string',
            'password' => 'required|string',
        ];
    }
}
