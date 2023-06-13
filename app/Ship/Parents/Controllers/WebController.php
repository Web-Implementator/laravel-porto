<?php

declare(strict_types=1);

namespace App\Ship\Parents\Controllers;

use App\Ship\Parents\Exceptions\UnknownInterfaceException;

abstract class WebController extends Controller
{
    /**
     * @throws UnknownInterfaceException
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {

            view()->share('language', session()->get('language'));

            return $next($request);
        });

        $this->setUi('web');
    }
}
