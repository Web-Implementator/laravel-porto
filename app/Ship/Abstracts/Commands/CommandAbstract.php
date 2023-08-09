<?php

declare(strict_types=1);

namespace App\Ship\Abstracts\Commands;

use App\Ship\Traits\UiTrait;
use Illuminate\Console\Command as Command;

abstract class CommandAbstract extends Command
{
    use UiTrait;
}
