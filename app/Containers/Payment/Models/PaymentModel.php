<?php

declare(strict_types=1);

namespace App\Containers\Payment\Models;

use App\Containers\Payment\Data\Enums\PaymentStatusEnum;
use App\Containers\Payment\Data\Enums\PaymentStatusNameEnum;
use App\Containers\User\Models\UserModel;
use App\Containers\User\Resources\UserResource;
use App\Ship\Parents\Models\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;

final class PaymentModel extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'payments';

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \App\Containers\Payment\Factories\PaymentModelFactory::new();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'is_active',
        'terminal_id',
        'user_id',
        'amount',
        'status_id',
        'paid_at',
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
    protected $with = [
        'user'
    ];

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
     * @param Builder $query
     * @param int $id
     * @return Builder
     */
    public function scopeUserId(Builder $query, int $id): Builder
    {
        return $query->where('user_id', $id);
    }

    /**
     * @return Attribute
     */
    public function statusText(): Attribute
    {
        return Attribute::make(
            get: function () {
                return PaymentStatusNameEnum::fromName(PaymentStatusEnum::from($this->status_id)->name);
            }
        );
    }
}
