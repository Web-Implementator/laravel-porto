<?php

namespace Database\Seeders;

use App\Containers\Car\Seeders\CarsTableSeeder;
use App\Containers\User\Seeders\UsersTableSeeder;

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
        ]);
    }
}
