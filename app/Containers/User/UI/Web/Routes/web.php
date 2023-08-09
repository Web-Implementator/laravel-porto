<?php

/**
 * Information for understanding
 *
 * Prefix none
 * Name Container Name Lower
 * Namespace App\Containers\User\UI\Web\Controllers
 */

Route::get('/user/{id}', 'UserController@user')->name('getById')->whereNumber('id');
