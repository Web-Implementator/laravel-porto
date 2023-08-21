<?php

declare(strict_types=1);

namespace App\Containers\User\UI\API\Requests;

use App\Ship\Abstracts\Requests\RequestApi;

final class UserCreateRequest extends RequestApi
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'isActive' => 'boolean',
            'name' => 'required|string',
            'email' => 'required|string',
            'password' => 'required|string',
        ];
    }
}
