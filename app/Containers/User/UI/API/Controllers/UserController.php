<?php

declare(strict_types=1);

namespace App\Containers\User\UI\API\Controllers;

use App\Containers\User\Actions\UserCreateAction;
use App\Containers\User\Actions\UserDeleteAction;
use App\Containers\User\Actions\UserGetByAction;
use App\Containers\User\Actions\UserGetAllAction;
use App\Containers\User\Actions\UserUpdateAction;
use App\Containers\User\Data\Transporters\UserDTO;
use App\Containers\User\Models\UserModel;
use App\Containers\User\UI\API\Requests\UserCreateRequest;
use App\Containers\User\UI\API\Requests\UserUpdateRequest;
use App\Ship\Abstracts\Controllers\ApiController;
use App\Ship\Core\Exceptions\PolicyException;
use App\Ship\Helpers\UserHelper;
use Illuminate\Http\JsonResponse;
use OpenApi\Annotations as OA;

final class UserController extends ApiController
{
    /**
     * PolicyAbstract for current Controller
     *
     * @see WebController
     *
     * @return ?string
     */
    protected function initPolicyModel(): ?string
    {
        return null;//UserModel::class;
    }

    /**
     * @OA\Get(
     *      path="/api/v1/user/getAll",
     *      operationId="userGetAll",
     *      tags={"User"},
     *      summary="Получить список пользователей",
     *
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *
     *          @OA\MediaType(
     *           mediaType="application/json",
     *          )
     *      ),
     *
     *      @OA\Response(
     *          response=500,
     *          description="Service Unavailable",
     *
     *          @OA\MediaType(
     *           mediaType="application/json",
     *          )
     *      ),
     *  )
     *
     * @return JsonResponse
     * @throws PolicyException
     */
    public function getAll(): JsonResponse
    {
        $user = UserHelper::authFake();

        $this->requestAccessCheck($user);

        return $this->response($this->action(UserGetAllAction::class, UserDTO::from([])));
    }

    /**
     * @OA\Get(
     *      path="/api/v1/user/{id}",
     *      operationId="userGetById",
     *      tags={"User"},
     *      summary="Получить пользователя по ID",
     *
     *      @OA\Parameter(
     *          description="ID User",
     *          in="path",
     *          name="id",
     *          required=true,
     *          example="1",
     *
     *          @OA\Schema(
     *              type="integer",
     *              format="int64"
     *          )
     *      ),
     *
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *
     *          @OA\MediaType(
     *           mediaType="application/json",
     *          )
     *      ),
     *
     *      @OA\Response(
     *          response=500,
     *          description="Service Unavailable",
     *
     *          @OA\MediaType(
     *           mediaType="application/json",
     *          )
     *      ),
     *  )
     *
     * @param int $id
     * @return JsonResponse
     * @throws PolicyException
     */
    public function getById(int $id): JsonResponse
    {
        $user = UserHelper::authFake();

        $this->requestAccessCheck($user);

        $response['data'] = $this->action(UserGetByAction::class, UserDTO::from(['userId' => $id]));

        return $this->response($response);
    }

    /**
     * @OA\Post(
     *      path="/api/v1/user/create",
     *      operationId="userCreate",
     *      tags={"User"},
     *      summary="Создать пользователя",
     *
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(
     *                  @OA\Property(
     *                      property="isActive",
     *                      type="boolean"
     *                  ),
     *                  @OA\Property(
     *                      property="name",
     *                      type="string"
     *                  ),
     *                  @OA\Property(
     *                      property="email",
     *                      type="string"
     *                  ),
     *                  @OA\Property(
     *                      property="password",
     *                      type="string"
     *                  )
     *              ),
     *          ),
     *      ),
     *
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *
     *          @OA\MediaType(
     *           mediaType="application/json",
     *          )
     *      ),
     *
     *      @OA\Response(
     *          response=500,
     *          description="Service Unavailable",
     *
     *          @OA\MediaType(
     *           mediaType="application/json",
     *          )
     *      ),
     *  )
     *
     * @param UserCreateRequest $request
     * @return JsonResponse
     */
    public function create(UserCreateRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $response['data'] = $this->action(UserCreateAction::class, UserDTO::from($validated));

        return $this->response($response);
    }

    /**
     * @OA\Post(
     *      path="/api/v1/user/edit",
     *      operationId="userUpdate",
     *      tags={"User"},
     *      summary="Обновить пользователя по ID",
     *
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(
     *                  @OA\Property(
     *                      property="userId",
     *                      type="int"
     *                  ),
     *                  @OA\Property(
     *                      property="isActive",
     *                      type="boolean"
     *                  ),
     *                  @OA\Property(
     *                      property="name",
     *                      type="string"
     *                  ),
     *                  @OA\Property(
     *                      property="email",
     *                      type="string"
     *                  ),
     *                  @OA\Property(
     *                      property="password",
     *                      type="string"
     *                  )
     *              ),
     *          ),
     *      ),
     *
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *
     *          @OA\MediaType(
     *           mediaType="application/json",
     *          )
     *      ),
     *
     *      @OA\Response(
     *          response=500,
     *          description="Service Unavailable",
     *
     *          @OA\MediaType(
     *           mediaType="application/json",
     *          )
     *      ),
     *  )
     *
     * @param UserUpdateRequest $request
     * @return JsonResponse
     */
    public function update(UserUpdateRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $response['data'] = $this->action(UserUpdateAction::class, UserDTO::from($validated));

        return $this->response($response);
    }

    /**
     * @OA\Delete(
     *      path="/api/v1/user/delete",
     *      operationId="userDelete",
     *      tags={"User"},
     *      summary="Удалить пользователя по ID",
     *
     *      @OA\Parameter(
     *          name="userId",
     *          in="query",
     *          required=true,
     *
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *
     *          @OA\MediaType(
     *           mediaType="application/json",
     *          )
     *      ),
     *
     *      @OA\Response(
     *          response=500,
     *          description="Service Unavailable",
     *
     *          @OA\MediaType(
     *           mediaType="application/json",
     *          )
     *      ),
     *  )
     *
     * @param int $id
     * @return JsonResponse
     */
    public function delete(int $id): JsonResponse
    {
        $response['data'] = $this->action(UserDeleteAction::class, UserDTO::from(['userId' => $id]));

        return $this->response($response);
    }
}
