<?php

declare(strict_types=1);

namespace App\Ship\Core\Providers;

use App\Ship\Abstracts\Providers\BroadcastServiceProviderAbstract;
use Illuminate\Support\Facades\Broadcast as IlluminateBroadcast;

final class BroadcastServiceProvider extends BroadcastServiceProviderAbstract
{
    /**
     * @return void
     */
    public function boot(): void
    {
        parent::boot();

        //
    }
}
