<?php

declare(strict_types=1);

namespace App\Ship\Core\Providers;

use App\Ship\Abstracts\Providers\RouteServiceProviderAbstract;

class RouteServiceProvider extends RouteServiceProviderAbstract
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';
}
