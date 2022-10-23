<?php

declare(strict_types=1);

namespace App\Ship\Generic\Middlewares;

use App\Ship\Parents\Middlewares\VerifyCsrfTokenMiddleware;

final class VerifyCsrfToken extends VerifyCsrfTokenMiddleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @const array<int, string>
     */
    protected $except = [
        '/payment/tinkoff',
        '/api/payment/*',
        '/api/notification/webHook/*',
        '/api/v2/notification/whatsapp/send',
    ];
}
