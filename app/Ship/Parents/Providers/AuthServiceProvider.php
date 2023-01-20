<?php

declare(strict_types=1);

namespace App\Ship\Parents\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as IlluminateAuthServiceProvider;

final class AuthServiceProvider extends IlluminateAuthServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @const array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->registerPolicies();

        //
    }
}
