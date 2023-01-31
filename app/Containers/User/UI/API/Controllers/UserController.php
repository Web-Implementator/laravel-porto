<?php

declare(strict_types=1);

namespace App\Containers\User\UI\API\Controllers;

use App\Containers\User\Actions\UserCreateAction;
use App\Containers\User\Actions\UserDeleteAction;
use App\Containers\User\Actions\UserLoginAction;
use App\Containers\User\Actions\UserLogoutAction;
use App\Containers\User\Actions\UserRegisterAction;
use App\Containers\User\Actions\UserUpdateAction;
use App\Containers\User\Data\Transporters\UserCreateDTO;
use App\Containers\User\Data\Transporters\UserLoginDTO;
use App\Containers\User\Data\Transporters\UserRegisterDTO;
use App\Containers\User\Data\Transporters\UserUpdateDTO;
use App\Containers\User\UI\API\Requests\UserCreateRequest;
use App\Containers\User\UI\API\Requests\UserEditRequest;
use App\Containers\User\UI\API\Requests\UserLoginRequest;
use App\Containers\User\Actions\GetUserAction;
use App\Containers\User\Actions\GetUsersAction;
use App\Containers\User\Data\Transporters\GetUserDTO;

use App\Containers\User\UI\API\Requests\UserRegisterRequest;
use App\Ship\Parents\Controllers\ApiController;

use Illuminate\Http\JsonResponse;

use Session;

use Spatie\DataTransferObject\Exceptions\UnknownProperties;

final class UserController extends ApiController
{
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
     */
    public function getAll(): JsonResponse
    {
        return response()->json(app(GetUsersAction::class)->run());
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
     * @throws UnknownProperties
     */
    public function getById(int $id): JsonResponse
    {
        return response()->json(app(GetUserAction::class)->run(new GetUserDTO(id: $id)));
    }

    /**
     * @param UserCreateRequest $request
     * @return JsonResponse
     * @throws UnknownProperties
     */
    public function create(UserCreateRequest $request): JsonResponse
    {
        $validated = $request->validated();

        return response()->json(app(UserCreateAction::class)->run(new UserCreateDTO($validated)));
    }

    /**
     * @param UserEditRequest $request
     * @param int $id
     * @return JsonResponse
     * @throws UnknownProperties
     */
    public function edit(UserEditRequest $request, int $id): JsonResponse
    {
        $validated = $request->validated();

        return response()->json(app(UserUpdateAction::class)->run(new UserUpdateDTO(id: $id, details: $validated)));
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function delete(int $id): JsonResponse
    {
        return response()->json(app(UserDeleteAction::class)->run($id));
    }
}
