<?php

/**
 * Information for understanding
 *
 * Prefix /api/v1/user
 * Name api.v1.user-
 * Namespace App\Containers\User\UI\API\Controllers
 */

Route::post('/login', 'UserController@login');
Route::post('/register', 'UserController@register');

Route::middleware('auth:sanctum')->group(function () {
    // Список пользователей
    Route::get('/getAll', 'UserController@getAll')->name('getAll');

    // Получить пользователя
    Route::get('/{id}', 'UserController@getById')->name('getById')->whereNumber('id');

    // Выход
    Route::post('/logout', 'UserController@logout');
});
