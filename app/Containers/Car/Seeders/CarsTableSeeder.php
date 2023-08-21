<?php

declare(strict_types=1);

namespace App\Containers\Car\Seeders;

use App\Containers\Car\Models\CarModel;
use App\Ship\Helpers\AppHelper;
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
        if (AppHelper::isLocal()) {
            CarModel::factory(100)->create();
        }
    }
}
