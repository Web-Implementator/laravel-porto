<?php

declare(strict_types=1);

namespace App\Ship\Generic\Middlewares;

use App\Ship\Generic\Providers\RouteServiceProvider;

use Closure;
use Request;
use Response;
use RedirectResponse;
use Auth;

final class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  Closure(Request): (Response|RedirectResponse)  $next
     * @param  ?string  ...$guards
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next, ?string ...$guards): Response|RedirectResponse
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return redirect(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }
}
