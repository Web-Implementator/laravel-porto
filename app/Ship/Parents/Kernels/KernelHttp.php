<?php

declare(strict_types=1);

namespace App\Ship\Parents\Kernels;

use App\Ship\Generic\Middlewares\{
    ApiResponse,
    Language,
};

use App\Ship\Parents\Middlewares\{
    Authenticate,
    EncryptCookies,
    PreventRequestsDuringMaintenance,
    RedirectIfAuthenticated,
    TrimStrings,
    TrustProxies,
    ValidateSignature,
    VerifyCsrfToken,
};

use Illuminate\Foundation\Http\Kernel;

final class KernelHttp extends Kernel
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
        \Illuminate\Http\Middleware\HandleCors::class,
        PreventRequestsDuringMaintenance::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @const array<string, array<int, class-string|string>>
     */
    protected $middlewareGroups = [
        'web' => [
            EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            Language::class,
        ],

        'api' => [
            // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
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
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'auth.session' => \Illuminate\Session\Middleware\AuthenticateSession::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => RedirectIfAuthenticated::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'signed' => ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
    ];
}
