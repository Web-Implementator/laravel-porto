<?php

declare(strict_types=1);

namespace App\Containers\Car\Tests;

use App\Ship\Parents\Tests\PhpUnit;

final class ApiTest extends PhpUnit
{
    /**
     * @return void
     */
    public function test_car_get_all(): void
    {
        $response = $this->get(route('api.v1.car.getAll'));
        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_car_get_by_id(): void
    {
        $response = $this->get(route('api.v1.car.getById', ['id' => 1]));
        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_rent_get_all(): void
    {
        $response = $this->get(route('api.v1.car.rent.getAll'));
        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_rent_get_by_id(): void
    {
        $response = $this->get(route('api.v1.car.rent.getById', ['id' => 1]));
        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_car_rent_begin(): void
    {
        $response = $this->post(route('api.v1.car.rent.begin'), [
            'car_id' => 1,
            'user_id' => 1,
        ]);
        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_car_rent_end(): void
    {
        $response = $this->post(route('api.v1.car.rent.end'), [
            'car_id' => 1,
            'user_id' => 1,
        ]);
        $response->assertStatus(200);
    }
}
