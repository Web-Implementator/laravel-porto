<?php

declare(strict_types=1);

namespace App\Ship\Parents\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as IlluminateController;

abstract class Controller extends IlluminateController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
