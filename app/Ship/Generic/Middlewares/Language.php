<?php

declare(strict_types=1);

namespace App\Ship\Generic\Middlewares;

use Closure;
use Illuminate\Http\Request;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

final class Language
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return mixed
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function handle(Request $request, Closure $next): mixed
    {
        if (session()->has('language')) {
            app()->setLocale(session()->get('language'));
        } else {
            session()->put('language', app()->currentLocale());
        }

        return $next($request);
    }
}
