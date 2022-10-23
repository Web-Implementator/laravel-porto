<?php

declare(strict_types=1);

namespace App\Ship\Generic\Requests;

use App\Ship\Parents\Requests\Request;

use Illuminate\Validation\ValidationException;
use Validator;

final class RequestWeb extends Request
{
    /**
     * @param Validator $validator
     * @return void
     */
    protected function failedValidation(Validator $validator): void
    {
        $error = $validator->errors();
        $errorMessage = $error->first();

        session()->flash('error', $errorMessage);
    }
}
