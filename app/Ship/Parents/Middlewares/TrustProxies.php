<?php

declare(strict_types=1);

namespace App\Ship\Parents\Middlewares;

use Illuminate\Http\Middleware\TrustProxies as IlluminateTrustProxies;
use Symfony\Component\HttpFoundation\Request;

final class TrustProxies extends IlluminateTrustProxies
{
    /**
     * The trusted proxies for this application.
     *
     * @const array<int, string>|string|null
     */
    protected $proxies;

    /**
     * The headers that should be used to detect proxies.
     *
     * @const int
     */
    protected $headers =
        Request::HEADER_X_FORWARDED_FOR |
        Request::HEADER_X_FORWARDED_HOST |
        Request::HEADER_X_FORWARDED_PORT |
        Request::HEADER_X_FORWARDED_PROTO |
        Request::HEADER_X_FORWARDED_AWS_ELB;
}
