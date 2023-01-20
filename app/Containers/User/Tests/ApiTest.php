<?php

declare(strict_types=1);

namespace App\Containers\User\Tests;

use App\Ship\Parents\Tests\PhpUnit;

final class ApiTest extends PhpUnit
{
    /**
     * @return void
     */
    public function test_get_users(): void
    {
        $response = $this->get(route('api.v1.user.getAll'));
        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_get_user(): void
    {
        $response = $this->get(route('api.v1.user.getById', ['id' => 1]));
        $response->assertStatus(200);
    }
}
