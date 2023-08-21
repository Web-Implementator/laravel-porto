<?php

declare(strict_types=1);

/**
 * Information for understanding
 *
 * Prefix /api/v1/user
 * Name api.v1.user.
 * Namespace App\Containers\User\UI\API\Controllers
 */

// Список пользователей
Route::get('/getAll', 'UserController@getAll')->name('getAll');

// Получить пользователя
Route::get('/{id}', 'UserController@getById')->name('getById')->whereNumber('id');

// Создать пользователя
Route::post('/create', 'UserController@create')->name('create');

// Обновить пользователя
Route::post('/edit', 'UserController@update')->name('update');

// Удалить пользователя
Route::delete('/delete', 'UserController@delete')->name('delete');
