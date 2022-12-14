<?php

declare(strict_types=1);

namespace App\Containers\User\UI\API\Controllers;

use App\Containers\User\Actions\GetUserAction;
use App\Containers\User\Actions\GetUsersAction;
use App\Containers\User\Data\Transporters\GetUserDTO;
use App\Containers\User\UI\API\Transformers\GetUsersTransformer;

use App\Containers\User\UI\API\Transformers\GetUserTransformer;
use App\Ship\Generic\Controllers\ApiController;
use App\Ship\Generic\Transformers\Serializers\ArraySerializer;

use JsonResponse;

final class UserController extends ApiController
{
    /**
     * @OA\Get(
     *      path="/api/v1/users",
     *      operationId="getUsers",
     *      tags={"User"},
     *      summary="Получить список пользователей",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\MediaType(
     *           mediaType="application/json",
     *          )
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Service Unavailable",
     *          @OA\MediaType(
     *           mediaType="application/json",
     *          )
     *      ),
     *  )
     * @return JsonResponse
     */
    public function getAll(): JsonResponse
    {
        try {
            return new JsonResponse(
                fractal()
                    ->item(app(GetUsersAction::class)->run())
                    ->transformWith(new GetUsersTransformer())
                    ->serializeWith(new ArraySerializer())
                    ->toArray()
            );
        } catch (Throwable $e) {
            report($e);
            return $this->responseServiceUnavailable();
        }
    }

    /**
     * @OA\Get(
     *      path="/api/v1/user/{id}",
     *      operationId="getUserById",
     *      tags={"User"},
     *      summary="Получить пользователя по ID",
     *      @OA\Parameter(
     *          description="ID User",
     *          in="path",
     *          name="id",
     *          required=true,
     *          example="1",
     *          @OA\Schema(
     *              type="integer",
     *              format="int64"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\MediaType(
     *           mediaType="application/json",
     *          )
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Service Unavailable",
     *          @OA\MediaType(
     *           mediaType="application/json",
     *          )
     *      ),
     *  )
     * @param int $id
     * @return JsonResponse
     */
    public function getById(int $id): JsonResponse
    {
        try {
            return new JsonResponse(
                fractal()
                    ->item(app(GetUserAction::class)->run(new GetUserDTO(id: $id)))
                    ->transformWith(new GetUserTransformer())
                    ->serializeWith(new ArraySerializer())
                    ->toArray()
            );
        } catch (Throwable $e) {
            report($e);
            return $this->responseServiceUnavailable();
        }
    }
}
