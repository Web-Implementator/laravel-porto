<?php

declare(strict_types=1);

namespace App\Ship\Abstracts\Requests;

use Illuminate\Contracts\Validation\Validator;

abstract class RequestWeb extends RequestAbstract
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
