<?php

declare(strict_types=1);

namespace App\Ship\Parents\Middlewares;

use Illuminate\Auth\Middleware\Authenticate as IlluminateAuthenticate;
use Illuminate\Http\Request;

final class Authenticate extends IlluminateAuthenticate
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  Request  $request
     * @return ?string
     */
    protected function redirectTo($request): ?string
    {
        if (!$request->expectsJson()) {
            return route('auth');
        }
    }
}
