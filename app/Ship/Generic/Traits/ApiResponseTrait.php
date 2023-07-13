<?php

declare(strict_types=1);

namespace App\Ship\Generic\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponseTrait
{
    /**
     * Метод добавляем сообщение в определённом стиле к API ответу
     *
     * @param mixed $response
     * @param string $message
     * @param ?int $code
     * @return array
     */
    public function addMessage(mixed $response, string $message, ?int $code = 200): array
    {
        $type = match ($code) {
            500 => 'error',
            400 => 'warning',
            default => 'success'
        };

        $response['message'] = [
            'type' => $type,
            'message' => $message,
        ];

        return $response;
    }

    /**
     * @param mixed $response
     * @param ?int $code
     * @return JsonResponse
     */
    public function response(mixed $response, ?int $code = 200): JsonResponse
    {
        return response()->json($response, $code);
    }
}
