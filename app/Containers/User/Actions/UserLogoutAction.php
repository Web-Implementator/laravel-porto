<?php

declare(strict_types=1);

namespace App\Containers\User\Actions;

use App\Ship\Parents\Actions\Action;

use Auth, Session;

final class UserLogoutAction extends Action
{
    public function __construct(
    ) {
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function run(): array
    {
        Auth::user()->tokens()->where('id', auth()->id())->delete();

        Session::flush();

        return [
            'status' => auth()->id()
        ];
    }
}
