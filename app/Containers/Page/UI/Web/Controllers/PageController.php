<?php

declare(strict_types=1);

namespace App\Containers\Page\UI\Web\Controllers;

use App\Ship\Parents\Controllers\WebController;

final class PageController extends WebController
{
    /**
     * Policy for current Controller
     *
     * @return ?string
     * @see WebController
     */
    protected function initPolicyModel(): ?string
    {
        return null;
    }

    /**
     * @return mixed
     */
    public function home(): mixed
    {
        return view('home');
    }
}
