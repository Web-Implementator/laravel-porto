<?php

declare(strict_types=1);

namespace App\Ship\Abstracts\Transporters;

use App\Ship\Contracts\DataInterface;
use Spatie\LaravelData\Data as SpatieData;

abstract class DataAbstract extends SpatieData implements DataInterface
{

}
