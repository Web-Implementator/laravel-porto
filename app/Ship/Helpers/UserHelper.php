<?php

use App\Containers\User\Models\UserModel;

/**
 * Fake authorisation
 *
 * @return UserModel
 */
function authFake(): UserModel
{
    $users = UserModel::all();

    if (count($users) === 0) {
        abort(403);
    }

    $user = $users[0];

    auth()->login($user);

    return $user;
}
