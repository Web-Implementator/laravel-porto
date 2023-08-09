<?php

declare(strict_types=1);

namespace App\Ship\Core\Middlewares;

use Illuminate\Routing\Middleware\ValidateSignature as IlluminateValidateSignature;

final class ValidateSignature extends IlluminateValidateSignature
{
    /**
     * The names of the query string parameters that should be ignored.
     *
     * @var array<int, string>
     */
    protected $except = [
        // 'fbclid',
        // 'utm_campaign',
        // 'utm_content',
        // 'utm_medium',
        // 'utm_source',
        // 'utm_term',
    ];
}
