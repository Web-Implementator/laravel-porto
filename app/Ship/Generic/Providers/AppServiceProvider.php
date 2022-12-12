<?php

declare(strict_types=1);

namespace App\Ship\Generic\Providers;

use App\Ship\Parents\Providers\ServiceProvider;

use Illuminate\View\View;

final class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->mapMigrations();
        $this->mapViews();
    }

    /**
     * Register migrations for containers
     *
     * @return void
     */
    protected function mapMigrations(): void
    {
        // Базовая директория миграций
        $mainPath = database_path('migrations');

        // Директории миграций внутри контейнеров
        $directories_migrations = glob(app_path() . '/Containers/*/Data/Migrations' , GLOB_ONLYDIR);

        $paths = array_merge([$mainPath], $directories_migrations);

        $this->loadMigrationsFrom($paths);
    }

    /**
     * Register views for containers
     *
     * @return void
     */
    protected function mapViews(): void
    {
        // Базовая директория шаблонов
        $paths_views = config('view.paths');

        // Директории шаблонов внутри контейнеров
        $directories_template = glob(app_path() . '/Containers/*/UI/Web/Views' , GLOB_ONLYDIR);

        $paths = array_merge($paths_views, $directories_template);

        config(['view.paths' => $paths]);
    }
}
