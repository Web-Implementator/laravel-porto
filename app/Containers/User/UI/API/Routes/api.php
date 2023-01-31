<?php

/**
 * Information for understanding
 *
 * Prefix /api/v1/user
 * Name api.v1.user.
 * Namespace App\Containers\User\UI\API\Controllers
 */

Route::post('/login', 'AuthController@login');
Route::post('/register', 'AuthController@register');

Route::middleware('auth:sanctum')->group(function () {
    // Список пользователей
    Route::get('/getAll', 'UserController@getAll')->name('getAll');

    // Получить пользователя
    Route::get('/{id}', 'UserController@getById')->name('getById')->whereNumber('id');

    // Обновить пользователя
    Route::patch('/{id}', 'UserController@edit')->name('edit')->whereNumber('id');

    // Создать пользователя
    Route::post('/create', 'UserController@create')->name('create');

    // Удалить пользователя
    Route::delete('/{id}', 'UserController@delete')->name('create')->whereNumber('id');

    // Выход
    Route::post('/logout', 'AuthController@logout');
});
