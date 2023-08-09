<?php

declare(strict_types=1);

namespace App\Ship\Core\Middlewares;

use App\Ship\Abstracts\Middlewares\MiddlewareAbstract;
use App\Ship\Abstracts\Providers\RouteServiceProvider;
use App\Ship\Abstracts\Requests\Request;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

final class RedirectIfAuthenticated extends MiddlewareAbstract
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
