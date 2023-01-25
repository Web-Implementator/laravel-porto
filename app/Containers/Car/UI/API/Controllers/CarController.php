<?php

declare(strict_types=1);

namespace App\Containers\Car\UI\API\Controllers;

use App\Containers\Car\Actions\GetCarAction;
use App\Containers\Car\Actions\GetCarsAction;
use App\Containers\Car\Data\Transporters\GetCarDTO;

use App\Ship\Parents\Controllers\ApiController;

use Illuminate\Http\JsonResponse;

use Spatie\DataTransferObject\Exceptions\UnknownProperties;

final class CarController extends ApiController
{
    /**
     * @OA\Get(
     *      path="/api/v1/car/getAll",
     *      operationId="carGetAll",
     *      tags={"Car"},
     *      summary="Получение списка автомобилей",
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
        return response()->json(app(GetCarsAction::class)->run());
    }

    /**
     * @OA\Get(
     *      path="/api/v1/car/{id}",
     *      operationId="carGetById",
     *      tags={"Car"},
     *      summary="Получить автомобиль по ID",
     *      @OA\Parameter(
     *          description="ID Car",
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
        return response()->json(app(GetCarAction::class)->run(new GetCarDTO(id: $id)));
    }
}
