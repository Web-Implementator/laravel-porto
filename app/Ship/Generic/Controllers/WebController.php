<?php

declare(strict_types=1);

namespace App\Ship\Generic\Controllers;

use App\Ship\Parents\Controllers\Controller;

use Session;

class WebController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {

            view()->share('language', Session::get('language'));

            return $next($request);
        });
    }
}
