<?php

declare(strict_types=1);

namespace App\Ship\Abstracts\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

abstract class ModelAbstract extends Model
{
    use HasFactory;
}
