<?php

declare(strict_types=1);

namespace App\Ship\Core\Kernels;

use App\Ship\Abstracts\Kernels\KernelHttpAbstract;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Routing\Router;

final class KernelHttp extends KernelHttpAbstract
{
    /**
     * @param Application $app
     * @param Router $router
     */
    public function __construct(Application $app, Router $router)
    {
        /**
         * @see KernelHttpAbstract::initMiddlewareGroups
         */
        parent::initMiddlewareGroups(
            [

            ],
            [

            ]
        );

        /**
         * @see KernelHttpAbstract::initRouteMiddleware
         */
        parent::initRouteMiddleware([

        ]);

        parent::__construct($app, $router);
    }
}
