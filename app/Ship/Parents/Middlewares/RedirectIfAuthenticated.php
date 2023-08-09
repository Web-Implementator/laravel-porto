<?php

declare(strict_types=1);

namespace App\Ship\Parents\Middlewares;

use App\Ship\Parents\Providers\RouteServiceProvider;

use App\Ship\Parents\Requests\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Closure;

final class RedirectIfAuthenticated extends Middleware
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
            if (auth()->guard($guard)->check()) {
                return redirect(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }
}
