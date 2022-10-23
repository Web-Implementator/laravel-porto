<?php

declare(strict_types=1);

namespace App\Ship\Parents\Middlewares;

use Illuminate\Auth\Middleware\Authenticate;

abstract class AuthenticateMiddleware extends Authenticate
{
}
