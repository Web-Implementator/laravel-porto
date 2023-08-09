<?php

declare(strict_types=1);

namespace App\Containers\User\UI\Web\Controllers;

use App\Containers\User\Models\UserModel;
use App\Ship\Parents\Controllers\WebController;
use Illuminate\Auth\Access\AuthorizationException;

final class UserController extends WebController
{
    /**
     * Policy for current Controller
     *
     * @see WebController
     * @return ?string
     */
    protected function initPolicyModel(): ?string
    {
        return UserModel::class;
    }

    /**
     * Policy usage example
     *
     * @param int $id
     * @return mixed
     * @throws AuthorizationException
     */
    public function user(int $id): mixed
    {
        $user = UserModel::findOrFail($id);

        auth()->login($user);

        $this->pageAccessCheck($user);

        return view('user', [
            'user' => $user
        ]);
    }
}
