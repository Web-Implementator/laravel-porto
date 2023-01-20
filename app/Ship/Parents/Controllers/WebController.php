<?php

declare(strict_types=1);

namespace App\Ship\Parents\Controllers;

use Session;

abstract class WebController extends Controller
{
    /**
     * The type of this controller. This will be accessibly mirrored in the Actions.
     * Giving each Action the ability to modify it's internal business logic based on the UI type that called it.
     */
    public string $ui = 'web';

    public function __construct()
    {
        $this->middleware(function ($request, $next) {

            view()->share('language', Session::get('language'));

            return $next($request);
        });
    }
}
