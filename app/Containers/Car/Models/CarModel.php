<?php

declare(strict_types=1);

namespace App\Containers\Car\Models;

use App\Containers\Car\Data\Enums\CarStatusEnum;
use App\Containers\Car\Data\Enums\CarStatusNameEnum;
use App\Ship\Parents\Models\Model;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;

final class CarModel extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cars';

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \App\Containers\Car\Factories\CarModelFactory::new();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'brand',
        'model',
        'state_number',
        'status_id',
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
    protected $casts = [
        'is_active' => 'boolean'
    ];

    /**
     * @var array
     */
    protected $with = [];

    /**
     * Диапазон запроса, включающий только активные элементы
     *
     * @param  Builder $query
     * @return Builder
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * @param Builder $query
     * @param int $id
     * @return Builder
     */
    public function scopePrimary(Builder $query, int $id): Builder
    {
        return $query->where('id', $id);
    }

    /**
     * @return Attribute
     */
    public function statusText(): Attribute
    {
        return Attribute::make(
            get: function () {
                return CarStatusNameEnum::fromName(CarStatusEnum::from($this->status_id)->name);
            }
        );
    }
}
