<?php

declare(strict_types=1);

namespace App\Containers\Car\Data\Transporters;

use Spatie\DataTransferObject\DataTransferObject;

final class UnRentCarDTO extends DataTransferObject
{
    /*** @var int */
    public int $car_id;

    /*** @var int */
    public int $user_id;
}
