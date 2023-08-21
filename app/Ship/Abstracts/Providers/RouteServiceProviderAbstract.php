<?php

declare(strict_types=1);

namespace App\Ship\Abstracts\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

abstract class RouteServiceProviderAbstract extends RouteServiceProvider
{
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
     * @return void
     */
    protected function mapApi(): void
    {
        $paths_api = array_merge(
            glob(app_path().'/Containers/*/*/UI/API/Routes/api.php'),
            glob(app_path().'/Containers/*/UI/API/Routes/api.php')
        );

        $api_version = $this->getApiVersion();

        foreach ($paths_api as $path) {
            $parse_path = explode('/', explode('Containers', $path)[1]);
            $container_name = $parse_path[1];
            $container_name_lower = strtolower($container_name);

            $container_name_sub = $parse_path[2];
            $container_name_sub_lower = strtolower($container_name_sub);

            if ($container_name_sub_lower !== 'ui') {
                $prefix = "/api/$api_version/$container_name_sub_lower";
                $name = "api.$api_version.$container_name_lower.$container_name_sub_lower.";
                $namespace = "$this->namespace\\$container_name\\$container_name_sub\\UI\\API\\Controllers";
            } else {
                $prefix = "/api/$api_version/$container_name_lower";
                $name = "api.$api_version.$container_name_lower.";
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
     * @return void
     */
    protected function mapWeb(): void
    {
        $paths_web = array_merge(
            glob(app_path().'/Containers/*/*/UI/Web/Routes/web.php'),
            glob(app_path().'/Containers/*/UI/Web/Routes/web.php')
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
     * @return void
     */
    protected function configureRateLimiting(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }

    /**
     * @return string
     */
    public function getApiVersion(): string
    {
        return $this->api_version;
    }

    /**
     * @param string $api_version
     * @return void
     */
    public function setApiVersion(string $api_version): void
    {
        $this->api_version = $api_version;
    }
}
