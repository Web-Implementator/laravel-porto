<?php

declare(strict_types=1);

namespace App\Ship\Parents\Transporters;

use App\Ship\Parents\Contracts\DataInterface;
use Spatie\LaravelData\Data as SpatieData;

abstract class Data extends SpatieData implements DataInterface
{

}
