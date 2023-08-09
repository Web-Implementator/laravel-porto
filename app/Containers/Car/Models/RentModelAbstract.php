<?php

declare(strict_types=1);

namespace App\Containers\Car\Models;

use App\Containers\Car\Resources\CarResource;
use App\Containers\User\Models\UserModel;
use App\Containers\User\Resources\UserResource;
use App\Ship\Abstracts\Models\ModelAbstract;
use Illuminate\Database\Eloquent\Builder;

final class RentModelAbstract extends ModelAbstract
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
     * @var array
     */
    protected $with = [
        'car',
        'user'
    ];

    /**
     * @return CarResource
     */
    public function car(): CarResource
    {
        return new CarResource($this->belongsTo(CarModelAbstract::class, 'car_id', 'id'));
    }

    /**
     * @return UserResource
     */
    public function user(): UserResource
    {
        return new UserResource($this->belongsTo(UserModel::class, 'user_id', 'id'));
    }

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
    public function scopeUserId(Builder $query, int $id): Builder
    {
        return $query->where('user_id', $id);
    }

    /**
     * @param Builder $query
     * @param int $id
     * @return Builder
     */
    public function scopeCarId(Builder $query, int $id): Builder
    {
        return $query->where('car_id', $id);
    }
}
