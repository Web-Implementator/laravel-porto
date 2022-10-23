<?php

declare(strict_types=1);

namespace App\Ship\Generic\Middlewares;

use App\Ship\Parents\Middlewares\PreventRequestsDuringMaintenanceMiddleware;

final class PreventRequestsDuringMaintenance extends PreventRequestsDuringMaintenanceMiddleware
{
    /**
     * The URIs that should be reachable while maintenance mode is enabled.
     *
     * @const array<int, string>
     */
    protected $except = [
        //
    ];
}
