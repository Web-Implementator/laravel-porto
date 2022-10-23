<?php

declare(strict_types=1);

namespace App\Ship\Generic\Middlewares;

use App\Ship\Parents\Middlewares\TrimStringsMiddleware;

final class TrimStrings extends TrimStringsMiddleware
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
