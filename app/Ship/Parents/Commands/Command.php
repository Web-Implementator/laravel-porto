<?php

declare(strict_types=1);

namespace App\Ship\Parents\Commands;

use Illuminate\Console\Command as IlluminateCommand;

abstract class Command extends IlluminateCommand
{
    /**
     * The type of this controller. This will be accessibly mirrored in the Actions.
     * Giving each Action the ability to modify it's internal business logic based on the UI type that called it.
     */
    public string $ui = 'cli';
}
