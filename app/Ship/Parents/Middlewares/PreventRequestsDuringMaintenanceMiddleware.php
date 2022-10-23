<?php

declare(strict_types=1);

namespace App\Ship\Parents\Middlewares;

use Illuminate\Foundation\Http\Middleware\PreventRequestsDuringMaintenance;

abstract class PreventRequestsDuringMaintenanceMiddleware extends PreventRequestsDuringMaintenance
{
}
