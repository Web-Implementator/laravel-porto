<?php

declare(strict_types=1);

namespace App\Ship\Abstracts\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

abstract class EventAbstract
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;
}
