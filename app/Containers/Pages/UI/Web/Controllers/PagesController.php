<?php

declare(strict_types=1);

namespace App\Containers\Pages\UI\Web\Controllers;

use App\Ship\Abstracts\Controllers\WebController;

final class PagesController extends WebController
{
    /**
     * PolicyAbstract for current Controller
     *
     * @return ?string
     *
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
