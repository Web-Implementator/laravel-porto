<?php

namespace App\Containers\Car\Seeders;

use App\Containers\Car\Models\CarModel;

use Illuminate\Database\Seeder;

final class CarsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        if (env('APP_ENV') === 'local') {
            CarModel::factory(10)->create();
        }
    }
}
