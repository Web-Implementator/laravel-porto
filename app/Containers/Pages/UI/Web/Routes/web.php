<?php

declare(strict_types=1);

/**
 * Information for understanding
 *
 * Prefix none
 * Name Container Name Lower
 * Namespace App\Containers\Pages\UI\Web\Controllers
 */

// Базовая страница с шаблоном внутри контейнера
Route::get('/home', 'PagesController@home')->name('home');
