<?php

declare(strict_types=1);

namespace App\Containers\Language\UI\Web\Requests;

use App\Ship\Parents\Requests\Request;

final class LanguageChangeRequest extends Request
{
    public function rules(): array
    {
        return [
            'locale' => 'required|string',
        ];
    }
}
