<?php

declare(strict_types=1);

namespace App\Containers\Car\Data\Transporters;

use Spatie\DataTransferObject\DataTransferObject;

final class RentUpdateDTO extends DataTransferObject
{
    /*** @var int */
    public int $id;

    /*** @var array */
    public array $details;
}
