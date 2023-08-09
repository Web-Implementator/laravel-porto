<?php

declare(strict_types=1);

namespace App\Ship\Core\Providers;

use App\Containers\User\Models\UserModel;
use App\Containers\User\Policies\UserPolicyAbstract;
use App\Ship\Abstracts\Providers\AuthServiceProviderAbstract;

final class AuthServiceProvider extends AuthServiceProviderAbstract
{
    /**
     * The policy mappings for the application.
     *
     * @const array<class-string, class-string>
     */
    protected $policies = [
        UserModel::class => UserPolicyAbstract::class,
    ];

    /**
     * @return void
     */
    public function boot(): void
    {
        parent::boot();

        //
    }
}
