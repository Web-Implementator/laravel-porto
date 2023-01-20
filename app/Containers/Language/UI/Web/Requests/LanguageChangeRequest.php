<?php

declare(strict_types=1);

namespace App\Containers\Language\UI\Web\Requests;

use App\Ship\Parents\Requests\RequestWeb;

final class LanguageChangeRequest extends RequestWeb
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
