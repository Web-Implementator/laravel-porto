<?php

declare(strict_types=1);

namespace App\Ship\Parents\Middlewares;

use Illuminate\Foundation\Http\Middleware\PreventRequestsDuringMaintenance as IlluminatePreventRequestsDuringMaintenance;

final class PreventRequestsDuringMaintenance extends IlluminatePreventRequestsDuringMaintenance
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
