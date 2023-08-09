<?php

declare(strict_types=1);

namespace App\Ship\Core\Middlewares;

use Illuminate\Foundation\Http\Middleware\TrimStrings as IlluminateTrimStrings;

final class TrimStrings extends IlluminateTrimStrings
{
    /**
     * The names of the attributes that should not be trimmed.
     *
     * @const array<int, string>
     */
    protected $except = [
        'current_password',
        'password',
        'password_confirmation',
    ];
}
