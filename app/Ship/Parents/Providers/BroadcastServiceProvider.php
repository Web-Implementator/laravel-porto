<?php

declare(strict_types=1);

namespace App\Ship\Parents\Providers;

use Illuminate\Support\Facades\Broadcast as IlluminateBroadcast;

final class BroadcastServiceProvider extends IlluminateBroadcast
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
