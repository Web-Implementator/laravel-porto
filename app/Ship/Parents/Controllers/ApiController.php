<?php

declare(strict_types=1);

namespace App\Ship\Parents\Controllers;

use App\Ship\Generic\Traits\ApiResponseTrait;
use App\Ship\Generic\Traits\MessageTrait;
use App\Ship\Parents\Exceptions\UnknownInterfaceException;
use Illuminate\Http\JsonResponse;

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
    use ApiResponseTrait;

    /**
     * @throws UnknownInterfaceException
     */
    public function __construct()
    {
        $this->setUi('api');
    }
}
