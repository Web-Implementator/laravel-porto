<?php

declare(strict_types=1);

namespace App\Ship\Abstracts\Providers;

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Broadcast as IlluminateBroadcast;

abstract class BroadcastServiceProviderAbstract extends Broadcast
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        IlluminateBroadcast::routes();

        require base_path('routes/channels.php');
    }
}
