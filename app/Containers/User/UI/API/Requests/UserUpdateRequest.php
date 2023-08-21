<?php

declare(strict_types=1);

namespace App\Containers\User\UI\API\Requests;

use App\Ship\Abstracts\Requests\RequestApi;

final class UserUpdateRequest extends RequestApi
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'userId' => 'required|int',
            'isActive' => 'boolean',
            'name' => 'string',
            'email' => 'string',
            'password' => 'string',
        ];
    }
}
