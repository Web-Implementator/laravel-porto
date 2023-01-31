<?php

declare(strict_types=1);

namespace App\Containers\Payment\Tests;

use App\Ship\Parents\Tests\PhpUnit;

final class ApiTest extends PhpUnit
{
    /**
     * @return void
     */
    public function test_payment_get_all(): void
    {
        $response = $this->get(route('api.v1.payment.getAll'));
        $response->assertStatus(200);
    }
}
