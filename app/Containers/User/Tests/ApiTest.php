<?php

declare(strict_types=1);

namespace App\Containers\User\Tests;

use App\Containers\User\Data\Repositories\UserRepository;
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
        $users = app(UserRepository::class)->getAll();
        $count = $users->count();

        if ($count > 0) {
            $user = last($users);

            $response = $this->get(route('api.v1.user.getById', ['id' => $user->id]));
            $response->assertStatus(200);

            $response = $this->get(route('api.v1.user.getById', ['id' => 'test']));
            $response->assertStatus(404);
        } else {
            $response = $this->get(route('api.v1.user.getById', ['id' => 1]));
            $response->assertStatus(400);
        }
    }
}
