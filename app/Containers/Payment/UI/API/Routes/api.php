<?php

/**
 * Information for understanding
 *
 * Prefix /api/v1/payment
 * Name api.v1.payment.
 * Namespace App\Containers\Payment\UI\API\Controllers
 */

Route::middleware('auth:sanctum')->group(function () {
    // Список платежей клиента
    Route::get('/user/{id}', 'PaymentController@getAllByUser')->name('getAllByUser');
});
