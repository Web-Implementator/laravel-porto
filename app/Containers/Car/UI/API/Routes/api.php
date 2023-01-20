<?php

/**
 * Information for understanding
 *
 * Prefix /api/v1/car
 * Name api.v1.car-
 * Namespace App\Containers\Car\UI\API\Controllers
 */

// Список машин
Route::get('/all', 'CarController@getAll')->name('getAll');

// Получить пользователя
Route::get('/{id}', 'CarController@getById')->name('getById');

Route::prefix('action')
    ->name('action.')
    ->group(function () {
        // Аренда машины
        Route::post('/rent', 'CarController@rent')->name('rent');

        // Завершить аренду машины
        Route::post('/unRent', 'CarController@unRent')->name('unRent');
    });
