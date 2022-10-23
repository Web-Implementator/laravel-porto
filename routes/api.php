<?php

use Illuminate\Support\Facades\Route;

use App\Containers\User\UI\API\Controllers\UserController;
use App\Containers\Car\UI\API\Controllers\CarController;

Route::prefix('v1')
    ->name('api-v1-')
    ->group(function () {

        // Список машин
        Route::get('/cars', [CarController::class, 'getAll'])
            ->name('get-cars');

        // Получить пользователя
        Route::get('/car/{id}', [CarController::class, 'getById'])
            ->name('get-car');

        // Аренда машины
        Route::post('/car/rent', [CarController::class, 'rent'])
            ->name('car-rent');

        // Завершить аренду машины
        Route::post('/car/unrent', [CarController::class, 'unrent'])
            ->name('car-unrent');

        // Список пользователей
        Route::get('/users', [UserController::class, 'getAll'])
            ->name('get-users');

        // Получить пользователя
        Route::get('/user/{id}', [UserController::class, 'getById'])
            ->name('get-user');
    });
