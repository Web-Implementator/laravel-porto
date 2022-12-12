<?php

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
