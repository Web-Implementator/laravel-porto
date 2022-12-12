<?php

declare(strict_types=1);

namespace App\Containers\User\UI\Web\Controllers;

use App\Ship\Generic\Controllers\WebController;

final class UserController extends WebController
{
    /**
     * @return mixed
     */
    public function users(): mixed
    {
        return view('welcome-container');
    }
}
