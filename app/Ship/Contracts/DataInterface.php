<?php

declare(strict_types=1);

namespace App\Ship\Contracts;

interface DataInterface
{
    /**
     * @return int|string
     */
    public function getPrimaryId(): int|string;
}
