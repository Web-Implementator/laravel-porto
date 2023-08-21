<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Containers\Car\Seeders\CarsTableSeeder;
use App\Containers\User\Seeders\UsersTableSeeder;
use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UsersTableSeeder::class,
            CarsTableSeeder::class,
        ]);
    }
}
