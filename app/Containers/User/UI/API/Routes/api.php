<?php

/**
 * Information for understanding
 *
 * Prefix api-v1-
 * Namespace App\Containers\Car\UI\API\Controllers
 */

// Список пользователей
Route::get('/users', 'UserController@getAll')->name('get-users');

// Получить пользователя
Route::get('/user/{id}', 'UserController@getById')->name('get-user');
