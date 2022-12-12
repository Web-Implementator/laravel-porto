<?php

/**
 * Information for understanding
 * 
 * Prefix api-v1-
 * Namespace App\Containers\Car\UI\API\Controllers
 */

// Список машин
Route::get('/cars', 'CarController@getAll')->name('get-cars');

// Получить пользователя
Route::get('/car/{id}', 'CarController@getById')->name('get-car');

// Аренда машины
Route::post('/car/action/rent', 'CarController@rent')->name('car-action-rent');

// Завершить аренду машины
Route::post('/car/action/unrent', 'CarController@unrent')->name('car-action-unrent');
