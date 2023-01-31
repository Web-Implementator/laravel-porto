<?php

declare(strict_types=1);

namespace App\Containers\User\Data\Transporters;

use App\Ship\Parents\Transporters\Data;

final class UserLoginDTO extends Data
{
    /*** @var string */
    public string $email;

    /*** @var string */
    public string $password;
}
