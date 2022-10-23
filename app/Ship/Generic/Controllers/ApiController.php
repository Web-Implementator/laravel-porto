<?php

declare(strict_types=1);

namespace App\Ship\Generic\Controllers;

use App\Ship\Parents\Controllers\Controller;

use JsonResponse;

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
class ApiController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function responseUnauthorized(): JsonResponse
    {
        return new JsonResponse([
            'message' => [
                'type' => 'error',
                'text' => 'Ошибка доступа'
            ]
        ], 403);
    }

    /**
     * @return JsonResponse
     */
    public function responseNotFound(): JsonResponse
    {
        return new JsonResponse([
            'message' => [
                'type' => 'error',
                'text' => 'Вызываемый метод API не найден'
            ]
        ], 404);
    }

    /**
     * @return JsonResponse
     */
    public function responseServiceUnavailable(): JsonResponse
    {
        return new JsonResponse([
            'message' => [
                'type' => 'error',
                'text' => 'Сервис временно недоступен, пожалуйста, повторите попытку позднее'
            ]
        ], 500);
    }
}
