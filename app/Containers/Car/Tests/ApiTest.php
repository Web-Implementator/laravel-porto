<?php

declare(strict_types=1);

namespace App\Containers\Car\Tests;

use App\Containers\Car\Data\Repositories\CarRepository;
use App\Containers\Car\Data\Repositories\RentRepository;
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
        $cars = app(CarRepository::class)->getAll();
        $count = $cars->count();

        if ($count > 0) {
            $car = last($cars);

            $response = $this->get(route('api.v1.car.getById', ['id' => $car->id]));
            $response->assertStatus(200);

            $response = $this->get(route('api.v1.car.getById', ['id' => 'test']));
            $response->assertStatus(404);
        } else {
            $response = $this->get(route('api.v1.car.getById', ['id' => 1]));
            $response->assertStatus(400);
        }
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
        $rents = app(RentRepository::class)->getAll();
        $count = $rents->count();

        if ($count > 0) {
            $rent = last($rents);

            $response = $this->get(route('api.v1.car.rent.getById', ['id' => $rent->id]));
            $response->assertStatus(200);

            $response = $this->get(route('api.v1.car.rent.getById', ['id' => 'test']));
            $response->assertStatus(404);
        } else {
            $response = $this->get(route('api.v1.car.rent.getById', ['id' => 1]));
            $response->assertStatus(400);
        }
    }

    /**
     * @return void
     */
    public function test_car_rent_begin(): void
    {
        $cars = app(CarRepository::class)->getAll();
        $count = $cars->count();

        $response = $this->post(route('api.v1.car.rent.begin'), [
            'car_id' => 1,
            'user_id' => 1,
        ]);

        if ($count > 0) {
            $response->assertStatus(200);
        } else {
            $response->assertStatus(400);
        }
    }

    /**
     * @return void
     */
    public function test_car_rent_end(): void
    {
        $cars = app(CarRepository::class)->getAll();
        $count = $cars->count();

        $response = $this->post(route('api.v1.car.rent.end'), [
            'car_id' => 1,
            'user_id' => 1,
        ]);

        if ($count > 0) {
            $response->assertStatus(200);
        } else {
            $response->assertStatus(400);
        }
    }
}
