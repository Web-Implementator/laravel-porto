<?php

namespace App\Containers\Car\Factories;

use App\Containers\Car\Models\CarModelAbstract;
use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

/**
 * @extends Factory<CarModelAbstract>
 */
final class CarModelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CarModelAbstract::class;

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
