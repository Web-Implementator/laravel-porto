<?php

declare(strict_types=1);

namespace App\Containers\Car\Data\Transporters;

use App\Ship\Parents\Transporters\Data;

final class GetRentDTO extends Data
{
    /*** @var int */
    public int $id;

    /*** @var ?int */
    public ?int $user_id;

    /*** @var ?int */
    public ?int $car_id;
}
