<?php

declare(strict_types=1);

namespace App\Ship\Parents\Requests;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

abstract class RequestApi extends Request
{
    /**
     * @param Validator $validator
     * @return mixed
     */
    protected function failedValidation(Validator $validator): mixed
    {
        throw new HttpResponseException(response()->json(['errors' => $validator->errors()], 422));
    }
}
