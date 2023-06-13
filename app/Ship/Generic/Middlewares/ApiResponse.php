<?php

namespace App\Ship\Generic\Middlewares;

use App,
    Closure;
use App\Ship\Generic\Exceptions\RentException;
use App\Ship\Generic\Traits\ApiResponseTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

final class ApiResponse
{
    use ApiResponseTrait;

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
                $responseCode = 400;
                $responseException = [
                    'data' => [],
                ];

                $responseException = $this->addMessage(
                    $responseException,
                    'По вашему запросу ничего не найдено',
                    $responseCode
                );

                return $this->response($responseException, $responseCode);
            } else if ($exception instanceof RentException) {
                $responseCode = 400;
                $responseException = [
                    'data' => [],
                ];

                $responseException = $this->addMessage(
                    $responseException,
                    $exception->getMessage(),
                    $responseCode
                );

                return $this->response($responseException, $responseCode);
            }
        }

        return $response;
    }
}
