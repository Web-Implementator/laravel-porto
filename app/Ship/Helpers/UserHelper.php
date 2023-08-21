<?php

declare(strict_types=1);

namespace App\Ship\Helpers;

use App\Containers\User\Models\UserModel;

final class UserHelper
{
    /**
     * Fake authorisation
     */
    public static function authFake(): UserModel
    {
        $users = UserModel::all();

        if (count($users) === 0) {
            abort(403);
        }

        $user = $users[0];

        auth()->login($user);

        return $user;
    }
}
