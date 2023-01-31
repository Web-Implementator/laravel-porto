<?php

namespace App\Containers\Payment\Factories;

use App\Containers\Payment\Models\PaymentModel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Containers\Payment\Models>
 */
final class PaymentModelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PaymentModel::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'terminal_id' => rand(1, 2),
            'user_id' => rand(1, 10),
            'amount' => rand(100, 10000),
        ];
    }
}
