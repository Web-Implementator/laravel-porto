<?php

declare(strict_types=1);

namespace App\Containers\User\Data\Transporters;

use Spatie\DataTransferObject\DataTransferObject;

final class GetUserDTO extends DataTransferObject
{
    /*** @var int */
    public int $id;
}
