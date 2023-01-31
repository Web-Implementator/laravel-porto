<?php

declare(strict_types=1);

namespace App\Containers\User\UI\API\Requests;

use App\Ship\Parents\Requests\RequestApi;

final class UserEditRequest extends RequestApi
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'name' => 'string',
            'email' => 'string',
            'password' => 'string',
        ];
    }
}
