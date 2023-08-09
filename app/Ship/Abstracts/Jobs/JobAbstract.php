<?php

declare(strict_types=1);

namespace App\Ship\Abstracts\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Bus\Queueable;
use Exception;

abstract class JobAbstract implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The job failed to process.
     *
     * @param Exception $exception
     *
     * @return void
     */
    public function failed(Exception $exception): void
    {
        // Send user notification of failure, etc...
//        if (app()->bound('sentry')) {
//            app('sentry')->captureException($exception);
//        }
    }
}
