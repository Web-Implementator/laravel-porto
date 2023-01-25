<?php

declare(strict_types=1);

namespace App\Containers\User\Tests;

use App\Ship\Parents\Tests\PhpUnit;

final class ApiTest extends PhpUnit
{
    /**
     * @return void
     */
    public function test_user_get_all(): void
    {
        $response = $this->get(route('api.v1.user.getAll'));
        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_user_get_by_id(): void
    {
        $response = $this->get(route('api.v1.user.getById', ['id' => 1]));
        $response->assertStatus(200);
    }
}
