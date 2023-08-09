<?php

declare(strict_types=1);

namespace App\Ship\Parents\Controllers;

use App\Ship\Parents\Exceptions\UnknownInterfaceException;
use Exception;

abstract class WebController extends Controller
{
    /**
     * @throws UnknownInterfaceException
     * @throws Exception
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {

            view()->share('language', session()->get('language'));

            return $next($request);
        });

        $this->setUi('web');

        // Description of the logic inside the final controller
        $this->setPolicyModel($this->initPolicyModel());

        // Register policy
        $this->policyRegister();
    }

    /**
     * Initialize policies
     *
     * @see \App\Ship\Parents\Controllers\Controller
     * @return ?string
     */
    abstract protected function initPolicyModel(): ?string;
}
