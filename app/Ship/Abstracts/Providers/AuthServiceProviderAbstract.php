<?php

declare(strict_types=1);

namespace App\Ship\Abstracts\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider;

abstract class AuthServiceProviderAbstract extends AuthServiceProvider
{
    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
