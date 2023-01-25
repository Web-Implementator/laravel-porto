<?php

namespace App\Ship\Generic\Middlewares;

use App,
    Closure,
    Exception,
    JsonResponse;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

use Spatie\DataTransferObject\Exceptions\UnknownProperties;

final class ExceptionApi
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        $response = $next($request);

        $exception = $response->exception ?? null;

        if (!empty($exception)) {
            if ($exception instanceof ModelNotFoundException) {
                return new JsonResponse([
                    'data' => [],
                    'message' => [
                        'type' => 'warning',
                        'text' => 'По вашему запросу ничего не найдено'
                    ]
                ], 200);
            } else if ($exception instanceof Exception) {
                return new JsonResponse([
                    'message' => [
                        'type' => 'warning',
                        'text' => $exception->getMessage()
                    ]
                ], 500);
            } else if ($exception instanceof UnknownProperties) {
                return new JsonResponse([
                    'message' => [
                        'type' => 'error',
                        'text' => $exception->getMessage()
                    ]
                ], 304);
            }

            report($exception);
            return new JsonResponse([
                'message' => [
                    'type' => 'error',
                    'text' => 'Сервис временно недоступен, пожалуйста, повторите попытку позднее'
                ]
            ], 500);
        }

        return $response;
    }
}
