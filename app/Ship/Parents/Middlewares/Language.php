<?php

namespace App\Ship\Parents\Middlewares;

use Illuminate\Http\Request;
use App,
    Closure,
    Session;

final class Language
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        if (Session::has('language')) {
            App::setLocale(Session::get('language'));
        } else {
            Session::put('language', App::currentLocale());
        }

        return $next($request);
    }
}
