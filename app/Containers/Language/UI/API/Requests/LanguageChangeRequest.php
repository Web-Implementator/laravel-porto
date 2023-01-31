<?php

declare(strict_types=1);

namespace App\Containers\Language\UI\API\Requests;

use App\Ship\Parents\Requests\RequestApi;

final class LanguageChangeRequest extends RequestApi
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'locale' => 'required|string',
        ];
    }
}
