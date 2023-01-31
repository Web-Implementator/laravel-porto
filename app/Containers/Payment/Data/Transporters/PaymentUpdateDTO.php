<?php

declare(strict_types=1);

namespace App\Containers\Payment\Data\Transporters;

use App\Ship\Parents\Transporters\Data;

final class PaymentUpdateDTO extends Data
{
    /*** @var int */
    public int $id;

    /*** @var array */
    public array $details;
}
