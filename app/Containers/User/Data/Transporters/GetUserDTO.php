<?php

declare(strict_types=1);

namespace App\Containers\User\Data\Transporters;

use App\Ship\Parents\Transporters\Data;

final class GetUserDTO extends Data
{
    /*** @var int */
    public int $id;
}
