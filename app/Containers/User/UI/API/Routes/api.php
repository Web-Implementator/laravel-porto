<?php

// Список пользователей
Route::get('/users', 'UserController@getAll')->name('get-users');

// Получить пользователя
Route::get('/user/{id}', 'UserController@getById')->name('get-user');
