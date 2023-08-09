<?php

declare(strict_types=1);

namespace App\Ship\Abstracts\Models;

use App\Ship\Contracts\ModelInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

abstract class ModelAbstract extends Model implements ModelInterface
{
    use HasFactory;
}
