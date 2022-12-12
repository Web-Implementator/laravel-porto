<?php

namespace App\Containers\Car\Data\Enums;

enum CarStatusEnum: int
{
    /**
     * Свободен
     */
    case free = 1;

    /**
     * Занят
     */
    case busy = 2;
}
