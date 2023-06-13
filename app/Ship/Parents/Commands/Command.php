<?php

declare(strict_types=1);

namespace App\Ship\Parents\Commands;

use App\Ship\Parents\Traits\UiTrait;
use Illuminate\Console\Command as IlluminateCommand;

abstract class Command extends IlluminateCommand
{
    use UiTrait;
}
