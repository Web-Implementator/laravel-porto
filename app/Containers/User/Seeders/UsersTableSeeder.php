<?php

namespace App\Containers\User\Seeders;

use App\Containers\User\Models\UserModel;
use Illuminate\Database\Seeder;

final class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        if (isLocal()) {
            UserModel::factory(10)->create();
        }
    }
}
