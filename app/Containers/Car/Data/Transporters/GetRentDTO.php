<?php

declare(strict_types=1);

namespace App\Containers\Car\Data\Transporters;

use Spatie\DataTransferObject\DataTransferObject;

final class GetRentDTO extends DataTransferObject
{
    /*** @var int */
    public int $id;

    /*** @var ?int */
    public ?int $user_id;

    /*** @var ?int */
    public ?int $car_id;
}
