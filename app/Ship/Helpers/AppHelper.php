<?php

declare(strict_types=1);

namespace App\Ship\Helpers;

final class AppHelper
{
    /**
     * Base directory project
     */
    public static function rootDir(): string
    {
        return dirname(__DIR__, 3);
    }

    /**
     * For local develop
     */
    public static function isLocal(): bool
    {
        return env('APP_ENV') === 'local';
    }

    public static function isProd(): bool
    {
        return env('APP_ENV') === 'production';
    }
}
