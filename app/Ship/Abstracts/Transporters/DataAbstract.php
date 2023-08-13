<?php

declare(strict_types=1);

namespace App\Ship\Abstracts\Transporters;

use Spatie\LaravelData\Data as SpatieData;

abstract class DataAbstract extends SpatieData
{
    /**
     * @return int|string
     */
    abstract public function getPrimaryId(): int|string;
}
