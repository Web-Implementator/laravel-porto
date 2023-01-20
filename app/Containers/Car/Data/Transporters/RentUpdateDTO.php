<?php

declare(strict_types=1);

namespace App\Containers\Car\Data\Transporters;

use App\Ship\Parents\Transporters\Data;

final class RentUpdateDTO extends Data
{
    /*** @var int */
    public int $id;

    /*** @var array */
    public array $details;
}
