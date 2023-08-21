<?php

declare(strict_types=1);

namespace App\Ship\Abstracts\Listeners;

abstract class ListenerAbstract
{
    /**
     * @param mixed $event
     * @return void
     */
    abstract public function handle(mixed $event): void;
}
