<?php

declare(strict_types=1);

namespace App\Ship\Abstracts\Providers;

use Illuminate\Support\ServiceProvider;

abstract class ServiceProviderAbstract extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     * @return void
     */
    public function boot(): void
    {
        $this->mapMigrations();
        $this->mapViews();
    }

    /**
     * Register migrations for containers
     * @return void
     */
    protected function mapMigrations(): void
    {
        $this->loadMigrationsFrom(array_merge(
            [
                database_path('migrations'), // Базовая директория миграций
            ],
            // Директории миграций внутри контейнеров
            glob(app_path().'/Containers/*/Data/Migrations', GLOB_ONLYDIR),
            glob(app_path().'/Containers/*/*/Data/Migrations', GLOB_ONLYDIR),
        ));
    }

    /**
     * Register views for containers
     * @return void
     */
    protected function mapViews(): void
    {
        config(['view.paths' => array_merge(
            config('view.paths'), // Базовая директория шаблонов
            // Директории шаблонов внутри контейнеров
            glob(app_path().'/Containers/*/UI/Web/Views', GLOB_ONLYDIR),
            glob(app_path().'/Containers/*/*/UI/Web/Views', GLOB_ONLYDIR),
        )]);
    }
}
