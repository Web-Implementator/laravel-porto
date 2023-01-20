<?php

declare(strict_types=1);

namespace App\Containers\Car\Tests;

use App\Ship\Parents\Tests\PhpUnit;

final class ApiTest extends PhpUnit
{
    /**
     * @return void
     */
    public function test_get_cars(): void
    {
        $response = $this->get(route('api.v1.car.getAll'));
        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_get_car(): void
    {
        $response = $this->get(route('api.v1.car.getById', ['id' => 1]));
        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_rent_car(): void
    {
        $response = $this->post(route('api.v1.car.action.rent'), [
            'car_id' => 1,
            'user_id' => 1,
        ]);
        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_unRent_car(): void
    {
        $response = $this->post(route('api.v1.car.action.unRent'), [
            'car_id' => 1,
            'user_id' => 1,
        ]);
        $response->assertStatus(200);
    }
}
