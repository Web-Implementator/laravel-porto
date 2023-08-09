<?php

declare(strict_types=1);

namespace App\Containers\User\UI\API\Controllers;

use App\Containers\User\Actions\GetUserAction;
use App\Containers\User\Actions\GetUsersAction;
use App\Containers\User\Data\Transporters\GetUserDTO;
use App\Containers\User\Models\UserModel;
use App\Ship\Core\Exceptions\PolicyException;
use App\Ship\Abstracts\Controllers\ApiController;
use Illuminate\Http\JsonResponse;
use OpenApi\Annotations as OA;

final class UserController extends ApiController
{
    /**
     * PolicyAbstract for current Controller
     *
     * @see WebController
     * @return ?string
     */
    protected function initPolicyModel(): ?string
    {
        return UserModel::class;
    }

    /**
     * @OA\Get(
     *      path="/api/v1/user/getAll",
     *      operationId="userGetAll",
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
     * @throws PolicyException
     */
    public function getAll(): JsonResponse
    {
        $user = authFake();

        $this->requestAccessCheck($user);

        return $this->response($this->action(GetUsersAction::class));
    }

    /**
     * @OA\Get(
     *      path="/api/v1/user/{id}",
     *      operationId="userGetById",
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
     * @throws PolicyException
     */
    public function getById(int $id): JsonResponse
    {
        $user = authFake();

        $this->requestAccessCheck($user);

        $response['data'] = $this->action(GetUserAction::class, GetUserDTO::from(['id' => $id]));

        return $this->response($response);
    }
}
