<?php

declare(strict_types=1);

namespace App\Ship\Parents\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Bus\Queueable;

use Carbon\Carbon;

abstract class Job implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /*** @var int Попытки */
    public $tries = 5;

    /**
     * Через сколько секунд задача может быть выполнена повторно
     *
     * @return int|null
     */
    public function backoff(): ?int
    {
        return 60;
    }

    /**
     * До какого времени задача будет находиться в очереди
     *
     * @return Carbon
     */
    public function retryUntil(): Carbon
    {
        return Carbon::now()->addWeek();
    }

    /**
     * The job failed to process.
     *
     * @param \Exception $exception
     *
     * @return void
     */
    public function failed(\Exception $exception)
    {
        // Send user notification of failure, etc...

        if (app()->bound('sentry')) {
            app('sentry')->captureException($exception);
        }
    }
}
