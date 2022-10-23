<?php

declare(strict_types=1);

namespace App\Ship\Generic\Middlewares;

use App\Ship\Parents\Middlewares\AuthenticateMiddleware;

final class Authenticate extends AuthenticateMiddleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('auth');
        }
    }
}
