<?php

declare(strict_types=1);

namespace App\Ship\Abstracts\Kernels;

use App\Ship\Core\Middlewares\ApiResponse;
use App\Ship\Core\Middlewares\Authenticate;
use App\Ship\Core\Middlewares\EncryptCookies;
use App\Ship\Core\Middlewares\Language;
use App\Ship\Core\Middlewares\PreventRequestsDuringMaintenance;
use App\Ship\Core\Middlewares\RedirectIfAuthenticated;
use App\Ship\Core\Middlewares\TrimStrings;
use App\Ship\Core\Middlewares\TrustProxies;
use App\Ship\Core\Middlewares\ValidateSignature;
use App\Ship\Core\Middlewares\VerifyCsrfToken;
use Illuminate\Auth\Middleware\AuthenticateWithBasicAuth;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified;
use Illuminate\Auth\Middleware\RequirePassword;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Foundation\Http\Kernel;
use Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull;
use Illuminate\Foundation\Http\Middleware\ValidatePostSize;
use Illuminate\Http\Middleware\HandleCors;
use Illuminate\Http\Middleware\SetCacheHeaders;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

abstract class KernelHttpAbstract extends Kernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @const array<int, class-string|string>
     */
    protected $middleware = [
        // TrustHosts::class,
        TrustProxies::class,
        HandleCors::class,
        PreventRequestsDuringMaintenance::class,
        ValidatePostSize::class,
        TrimStrings::class,
        ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @const array<string, array<int, class-string|string>>
     */
    protected $middlewareGroups = [
        'web' => [
            EncryptCookies::class,
            AddQueuedCookiesToResponse::class,
            StartSession::class,
            ShareErrorsFromSession::class,
            VerifyCsrfToken::class,
            SubstituteBindings::class,
            Language::class,
        ],

        'api' => [
            // \Laravel\Sanctum\Http\MiddlewareAbstract\EnsureFrontendRequestsAreStateful::class,
            'throttle:api',
            SubstituteBindings::class,
            ApiResponse::class,
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @const array<string, class-string|string>
     */
    protected $routeMiddleware = [
        'auth' => Authenticate::class,
        'auth.basic' => AuthenticateWithBasicAuth::class,
        'auth.session' => AuthenticateSession::class,
        'cache.headers' => SetCacheHeaders::class,
        'can' => Authorize::class,
        'guest' => RedirectIfAuthenticated::class,
        'password.confirm' => RequirePassword::class,
        'signed' => ValidateSignature::class,
        'throttle' => ThrottleRequests::class,
        'verified' => EnsureEmailIsVerified::class,
    ];

    /**
     * @param array $web
     * @param array $api
     * @return void
     */
    public function initMiddlewareGroups(array $web = [], array $api = []): void
    {
        $this->middlewareGroups['web'] = array_merge($this->middlewareGroups['web'], $web);
        $this->middlewareGroups['api'] = array_merge($this->middlewareGroups['api'], $api);
    }

    /**
     * @param array $routes
     * @return void
     */
    public function initRouteMiddleware(array $routes = []): void
    {
        $this->routeMiddleware = array_merge($this->routeMiddleware, $routes);
    }
}
