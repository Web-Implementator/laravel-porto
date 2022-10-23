<?php

declare(strict_types=1);

namespace App\Containers\User\Data\Transporters;

use Spatie\DataTransferObject\DataTransferObject;

final class UserUpdateDTO extends DataTransferObject
{
    /*** @var int */
    public int $id;

    /*** @var array */
    public array $details;
}
