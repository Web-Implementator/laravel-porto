<?php

namespace Database\Seeders;

use App\Containers\User\Seeders\UsersTableSeeder;
use App\Containers\Car\Seeders\CarsTableSeeder;
use App\Containers\Payment\Seeders\PaymentsTableSeeder;
use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $this->call([
            UsersTableSeeder::class,
            CarsTableSeeder::class,
            PaymentsTableSeeder::class
        ]);
    }
}
