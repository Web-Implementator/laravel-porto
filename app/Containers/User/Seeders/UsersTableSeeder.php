<?php

declare(strict_types=1);

namespace App\Containers\User\Seeders;

use App\Containers\User\Models\UserModel;
use App\Ship\Helpers\AppHelper;
use Illuminate\Database\Seeder;

final class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (AppHelper::isLocal()) {
            UserModel::factory(10)->create();
        }
    }
}
