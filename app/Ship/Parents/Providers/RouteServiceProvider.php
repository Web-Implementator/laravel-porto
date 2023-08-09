<?php

declare(strict_types=1);

namespace App\Ship\Parents\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as IlluminateRouteServiceProvider;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Request;

final class RouteServiceProvider extends IlluminateRouteServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    protected $namespace = 'App\\Containers';

    /**
     * @var string
     */
    private string $api_version = 'v1';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->configureRateLimiting();

        Route::pattern('id', '[0-9]+');

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            $this->mapApi();
            $this->mapWeb();
        });
    }

    /**
     * Register Api routes for containers
     *
     * @return void
     */
    protected function mapApi(): void
    {
        $paths_api = array_merge(
            glob(app_path() . '/Containers/*/*/UI/API/Routes/api.php'),
            glob(app_path() . '/Containers/*/UI/API/Routes/api.php')
        );

        foreach ($paths_api as $path) {
            $parse_path = explode('/', explode('Containers', $path)[1]);
            $container_name = $parse_path[1];
            $container_name_lower = strtolower($container_name);

            $container_name_sub = $parse_path[2];
            $container_name_sub_lower = strtolower($container_name_sub);

            if ($container_name_sub_lower !== 'ui') {
                $prefix = "api/$this->api_version/$container_name_sub_lower";
                $name = "api.$this->api_version.$container_name_lower.$container_name_sub_lower.";
                $namespace = "$this->namespace\\$container_name\\$container_name_sub\\UI\\API\\Controllers";
            } else {
                $prefix = "api/$this->api_version/$container_name_lower";
                $name = "api.$this->api_version.$container_name_lower.";
                $namespace = "$this->namespace\\$container_name\\UI\\API\\Controllers";
            }

            Route::middleware('api')
                ->prefix($prefix)
                ->name($name)
                ->namespace($namespace)
                ->group($path);
        }
    }

    /**
     * Register Web routes for containers
     *
     * @return void
     */
    protected function mapWeb(): void
    {
        $paths_web = array_merge(
            glob(app_path() . '/Containers/*/*/UI/Web/Routes/web.php'),
            glob(app_path() . '/Containers/*/UI/Web/Routes/web.php')
        );

        foreach ($paths_web as $path) {
            $parse_path = explode('/', explode('Containers', $path)[1]);

            $container_name = $parse_path[1];
            $container_name_lower = strtolower($container_name);

            $container_name_sub = $parse_path[2];
            $container_name_sub_lower = strtolower($container_name_sub);

            if ($container_name_sub_lower !== 'ui') {
                $name = "$container_name_lower.$container_name_sub_lower.";
                $namespace = "$this->namespace\\$container_name\\$container_name_sub\\UI\\Web\\Controllers";
            } else {
                $name = "$container_name_lower.";
                $namespace = "$this->namespace\\$container_name\\UI\\Web\\Controllers";
            }

            Route::middleware('web')
                ->name($name)
                ->namespace($namespace)
                ->group($path);
        }
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
