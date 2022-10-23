<?php

declare(strict_types=1);

namespace App\Ship\Generic\Providers;

use App\Ship\Parents\Providers\ServiceProvider;

use Illuminate\Support\Facades\Broadcast;

final class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Broadcast::routes();

        require base_path('routes/channels.php');
    }
}
