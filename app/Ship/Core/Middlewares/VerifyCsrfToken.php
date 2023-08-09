<?php

declare(strict_types=1);

namespace App\Ship\Core\Middlewares;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as IlluminateVerifyCsrfToken;

final class VerifyCsrfToken extends IlluminateVerifyCsrfToken
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @const array<int, string>
     */
    protected $except = [];
}
