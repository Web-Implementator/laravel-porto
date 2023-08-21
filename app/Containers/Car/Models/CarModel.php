<?php

declare(strict_types=1);

namespace App\Containers\Car\Models;

use App\Containers\Car\Data\Enums\CarStatusEnum;
use App\Containers\Car\Data\Enums\CarStatusNameEnum;
use App\Containers\Car\Events\CarCacheEvent;
use App\Containers\Car\Events\CarUpdateEvent;
use App\Containers\Car\Factories\CarModelFactory;
use App\Ship\Abstracts\Models\ModelAbstract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

final class CarModel extends ModelAbstract
{
    use HasFactory;

    /**
     * @return ?string
     */
    public function getPolicyName(): ?string
    {
        return 'user';
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cars';

    /**
     * Create a new factory instance for the model.
     * @return Factory
     */
    protected static function newFactory(): Factory
    {
        return CarModelFactory::new();
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
        'is_active' => 'boolean',
    ];

    /**
     * @var array
     */
    protected $with = [];

    /**
     * @param Builder $query
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
