<?php

declare(strict_types=1);

namespace App\Containers\Car\Data\Transporters;

use Spatie\DataTransferObject\DataTransferObject;

final class GetCarDTO extends DataTransferObject
{
    /*** @var int */
    public int $id;
}
