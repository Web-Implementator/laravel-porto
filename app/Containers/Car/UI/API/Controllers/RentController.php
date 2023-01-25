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
use App\Containers\Car\UI\API\Requests\RentRequest;
use App\Containers\Car\UI\API\Requests\UnRentRequest;

use App\Ship\Parents\Controllers\ApiController;

use Illuminate\Http\JsonResponse;

use Spatie\DataTransferObject\Exceptions\UnknownProperties;

final class RentController extends ApiController
{
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
        return response()->json(app(GetRentsAction::class)->run());
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
     * @throws UnknownProperties
     */
    public function getById(int $id): JsonResponse
    {
        return response()->json(app(GetRentAction::class)->run(new GetRentDTO(id: $id)));
    }

    /**
     * @OA\Post(
     *      path="/api/v1/car/rent/start",
     *      operationId="carRentBegin",
     *      tags={"Rent"},
     *      summary="Начать аренду автомобиля",
     *      @OA\Parameter(
     *          name="car_id",
     *          in="query",
     *          required=true,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="user_id",
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
     * @throws UnknownProperties
     */
    public function begin(RentRequest $request): JsonResponse
    {
        $validated = $request->validated();

        return response()->json(app(RentCarAction::class)->run(new RentCarDTO($validated)));
    }

    /**
     * @OA\Post(
     *      path="/api/v1/car/rent/end",
     *      operationId="carRentEnd",
     *      tags={"Rent"},
     *      summary="Завершить аренду автомобиля",
     *      @OA\Parameter(
     *          name="car_id",
     *          in="query",
     *          required=true,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="user_id",
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
     * @throws UnknownProperties
     */
    public function end(UnRentRequest $request): JsonResponse
    {
        $validated = $request->validated();

        return response()->json(app(UnRentCarAction::class)->run(new UnRentCarDTO($validated)));
    }
}
