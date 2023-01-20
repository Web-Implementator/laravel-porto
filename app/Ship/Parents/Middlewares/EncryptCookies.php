<?php

declare(strict_types=1);

namespace App\Ship\Parents\Middlewares;

use Illuminate\Cookie\Middleware\EncryptCookies as IlluminateEncryptCookies;

final class EncryptCookies extends IlluminateEncryptCookies
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
