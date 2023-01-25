<?php

/**
 * Information for understanding
 *
 * Prefix /api/v1/user
 * Name api.v1.user-
 * Namespace App\Containers\User\UI\API\Controllers
 */

// Список пользователей
Route::get('/getAll', 'UserController@getAll')->name('getAll');

// Получить пользователя
Route::get('/{id}', 'UserController@getById')->name('getById')->whereNumber('id');
