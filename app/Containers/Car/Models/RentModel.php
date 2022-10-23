<?php

declare(strict_types=1);

namespace App\Containers\Car\Models;

use App\Ship\Parents\Models\Model;
use Illuminate\Database\Eloquent\Builder;

final class RentModel extends Model
{
    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'rents';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'car_id',
        'user_id',
        'begin_at',
        'end_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [];

    /**
     * Диапазон запроса, включающий только активные элементы
     *
     * @param  Builder $query
     * @return Builder
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('end_at', null);
    }

    /**
     * @param Builder $query
     * @param int $id
     * @return Builder
     */
    public function scopeWhereId(Builder $query, int $id): Builder
    {
        return $query->where('id', $id);
    }

    /**
     * @param Builder $query
     * @param int $id
     * @return Builder
     */
    public function scopeWhereUserId(Builder $query, int $id): Builder
    {
        return $query->where('user_id', $id);
    }

    /**
     * @param Builder $query
     * @param int $id
     * @return Builder
     */
    public function scopeWhereCarId(Builder $query, int $id): Builder
    {
        return $query->where('car_id', $id);
    }
}
