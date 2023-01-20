<?php

declare(strict_types=1);

namespace App\Ship\Parents\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as IlluminateModel;

abstract class Model extends IlluminateModel
{
    use HasFactory;
}
