<?php

declare(strict_types=1);

namespace App\Ship\Generic\Middlewares;

use App\Ship\Parents\Middlewares\EncryptCookiesMiddleware;

final class EncryptCookies extends EncryptCookiesMiddleware
{
    /**
     * The names of the cookies that should not be encrypted.
     *
     * @const array<int, string>
     */
    protected $except = [
        //
    ];
}
