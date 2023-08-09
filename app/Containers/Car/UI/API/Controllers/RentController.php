<?php

declare(strict_types=1);

namespace App\Containers\Car\UI\API\Controllers;

use App\Containers\Car\Actions\GetRentAction;
use App\Containers\Car\Actions\GetRentsAction;
use App\Containers\Car\Actions\RentCarAction;
use App\Containers\Car\Actions\UnRentCarAction;
use App\Containers\Car\Data\Transporters\GetRentDTO;
use App\Containers\Car\Data\Transporters\RentCarDTO;
use App\Containers\Car\Data\Transporters\UnRentCarDTO;
use App\Containers\Car\Models\RentModel;
use App\Containers\Car\UI\API\Requests\RentRequest;
use App\Containers\Car\UI\API\Requests\UnRentRequest;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

final class RentController extends ApiController
{
    /**
     * Policy for current Controller
     *
     * @see WebController
     * @return ?string
     */
    protected function initPolicyModel(): ?string
    {
        return RentModel::class;
    }

    /**
     * @OA\Get(
     *      path="/api/v1/car/rent/getAll",
     *      operationId="carRentGetAll",
     *      tags={"Rent"},
     *      summary="Получить все аренды",
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
        return $this->response($this->action(GetRentsAction::class));
    }

    /**
     * @OA\Get(
     *      path="/api/v1/car/rent/{id}",
     *      operationId="carRentGetById",
     *      tags={"Rent"},
     *      summary="Получить аренду по ID",
     *      @OA\Parameter(
     *          description="ID Rent",
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
        $response['data'] = $this->action(GetRentAction::class, GetRentDTO::from(['rentId' => $id]));

        return $this->response($response);
    }

    /**
     * @OA\Post(
     *      path="/api/v1/car/rent/begin",
     *      operationId="carRentBegin",
     *      tags={"Rent"},
     *      summary="Начать аренду автомобиля",
     *      @OA\Parameter(
     *          name="carId",
     *          in="query",
     *          required=true,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="userId",
     *          in="query",
     *          required=true,
     *          @OA\Schema(
     *              type="integer"
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
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Service Unavailable",
     *          @OA\MediaType(
     *           mediaType="application/json",
     *          )
     *      ),
     *  )
     * @param RentRequest $request
     * @return JsonResponse
     */
    public function begin(RentRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $resource = $this->action(RentCarAction::class, RentCarDTO::from($validated));

        $response['data'] = $resource;

        $response = $this->addMessage($response,'Вы успешно арендовали автомобиль');

        return $this->response($response);
    }

    /**
     * @OA\Post(
     *      path="/api/v1/car/rent/end",
     *      operationId="carRentEnd",
     *      tags={"Rent"},
     *      summary="Завершить аренду автомобиля",
     *      @OA\Parameter(
     *          name="userId",
     *          in="query",
     *          required=true,
     *          @OA\Schema(
     *              type="integer"
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
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Service Unavailable",
     *          @OA\MediaType(
     *           mediaType="application/json",
     *          )
     *      ),
     *  )
     * @param UnRentRequest $request
     * @return JsonResponse
     */
    public function end(UnRentRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $resource = $this->action(UnRentCarAction::class, UnRentCarDTO::from($validated));

        $response['data'] = $resource;

        $response = $this->addMessage($response,'Вы успешно завершили аренду');

        return $this->response($response);
    }
}
