<?php

declare(strict_types=1);

namespace App\Containers\Car\Tests;

use App\Ship\Parents\Tests\PhpUnit\TestCase;

final class ApiTest extends TestCase
{
    /**
     * @return void
     */
    public function test_get_cars(): void
    {
        $response = $this->get(route('api-v1-get-cars'));
        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_get_car(): void
    {
        $response = $this->get(route('api-v1-get-car', ['id' => 1]));
        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_rent_car(): void
    {
        $response = $this->post(route('api-v1-car-rent'), [
            'car_id' => 1,
            'user_id' => 1,
        ]);
        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_unrent_car(): void
    {
        $response = $this->post(route('api-v1-car-unrent'), [
            'car_id' => 1,
            'user_id' => 1,
        ]);
        $response->assertStatus(200);
    }
}
