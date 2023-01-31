<?php

namespace App\Containers\Payment\Seeders;

use App\Containers\Payment\Models\PaymentModel;

use Illuminate\Database\Seeder;

final class PaymentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        if (env('APP_ENV') === 'local') {
            PaymentModel::factory(10)->create();
        }
    }
}
