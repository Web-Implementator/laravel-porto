<?php

declare(strict_types=1);

namespace App\Ship\Core\Kernels;

use App\Ship\Abstracts\Kernels\KernelConsoleAbstract;
use Illuminate\Console\Scheduling\Schedule;

final class KernelConsole extends KernelConsoleAbstract
{
    /**
     * @param  Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule): void
    {
        parent::schedule();
    }

    /**
     * @return void
     */
    protected function commands(): void
    {
        parent::commands();
    }
}
