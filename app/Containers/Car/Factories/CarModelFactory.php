<?php

namespace App\Containers\Car\Factories;

use App\Containers\Car\Models\CarModel;

use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Containers\Car\Models>
 */
final class CarModelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CarModel::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'brand' => fake()->text(10),
            'model' => fake()->text(8),
            'state_number' => Str::random(5),
        ];
    }
}
