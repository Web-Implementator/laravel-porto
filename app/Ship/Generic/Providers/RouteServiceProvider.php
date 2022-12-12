<?php

declare(strict_types=1);

namespace App\Ship\Generic\Providers;

use App\Ship\Parents\Providers\RouteServiceProvider as ServiceProvider;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Request;

final class RouteServiceProvider extends ServiceProvider
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
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->configureRateLimiting();

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
        $paths_api = glob(app_path() . '/Containers/*/UI/API/Routes/api.php');

        foreach ($paths_api as $path) {
            $container_name = explode('/', explode('Containers', $path)[1])[1];

            Route::prefix('api/v1')
                ->name('api-v1-')
                ->namespace("$this->namespace\\$container_name\\UI\\API\\Controllers")
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
        $paths_web = glob(app_path() . '/Containers/*/UI/Web/Routes/web.php');

        foreach ($paths_web as $path) {
            $container_name = explode('/', explode('Containers', $path)[1])[1];

            Route::middleware('web')
                ->namespace("$this->namespace\\$container_name\\UI\\Web\\Controllers")
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
