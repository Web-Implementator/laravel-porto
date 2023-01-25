<?php

declare(strict_types=1);

namespace App\Ship\Parents\Controllers;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Integration Swagger in Laravel 9",
 *      description="Implementation of Swagger with in Laravel 9",
 *      @OA\Contact(
 *          email="slava.akulov.1996@gmail.com"
 *      ),
 * )
 * @OA\Server(
 *      url=L5_SWAGGER_CONST_HOST,
 *      description="Demo API Server"
 * )
 */
abstract class ApiController extends Controller
{
    /**
     * The type of this controller. This will be accessibly mirrored in the Actions.
     * Giving each Action the ability to modify it's internal business logic based on the UI type that called it.
     */
    public string $ui = 'api';
}
