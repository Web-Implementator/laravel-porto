<?php

declare(strict_types=1);

namespace App\Ship\Generic\Providers;

use App\Ship\Parents\Providers\ServiceProvider;

final class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Базовая директория
        $mainPath = database_path('migrations');

        // Директория внутри контейнеров
        $directories = glob(app_path() . '/Containers/*/Data/Migrations' , GLOB_ONLYDIR);

        $paths = array_merge([$mainPath], $directories);

        $this->loadMigrationsFrom($paths);
    }
}
