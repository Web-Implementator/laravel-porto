<?php

declare(strict_types=1);

namespace App\Ship\Generic\Requests;

use App\Ship\Parents\Requests\Request;

use Illuminate\Http\Exceptions\HttpResponseException;
use Validator;

final class RequestApi extends Request
{
    /**
     * @param Validator $validator
     * @return mixed
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['errors' => $validator->errors()], 422));
    }
}
