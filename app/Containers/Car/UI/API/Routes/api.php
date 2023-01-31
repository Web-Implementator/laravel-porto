<?php

/**
 * Information for understanding
 *
 * Prefix /api/v1/car
 * Name api.v1.car-
 * Namespace App\Containers\Car\UI\API\Controllers
 */

Route::middleware('auth:sanctum')->group(function () {
    // Список машин
    Route::get('/getAll', 'CarController@getAll')->name('getAll');

    // Получить пользователя
    Route::get('/{id}', 'CarController@getById')->name('getById')->whereNumber('id');

    Route::prefix('rent')
        ->name('rent.')
        ->group(function () {
            // Список аренд
            Route::get('/getAll', 'RentController@getAll')->name('getAll');

            // Получить аренду
            Route::get('/{id}', 'RentController@getById')->name('getById')->whereNumber('id');

            // Начать аренду машины
            Route::post('/start', 'RentController@begin')->name('begin');

            // Завершить аренду машины
            Route::post('/end', 'RentController@end')->name('end');
        });
});
