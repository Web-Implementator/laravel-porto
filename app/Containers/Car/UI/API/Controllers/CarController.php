<?php

declare(strict_types=1);

namespace App\Containers\Car\UI\API\Controllers;

use App\Containers\Car\Actions\GetCarAction;
use App\Containers\Car\Actions\GetCarsAction;
use App\Containers\Car\Actions\RentCarAction;
use App\Containers\Car\Actions\UnRentCarAction;
use App\Containers\Car\Data\Transporters\GetCarDTO;
use App\Containers\Car\Data\Transporters\RentCarDTO;
use App\Containers\Car\Data\Transporters\UnRentCarDTO;
use App\Containers\Car\UI\API\Requests\RentRequest;
use App\Containers\Car\UI\API\Requests\UnRentRequest;
use App\Containers\Car\UI\API\Transformers\GetCarsTransformer;
use App\Containers\Car\UI\API\Transformers\CarRentTransformer;
use App\Containers\Car\UI\API\Transformers\CarUnRentTransformer;
use App\Containers\Car\UI\API\Transformers\GetCarTransformer;

use App\Ship\Parents\Controllers\ApiController;

use JsonResponse;

use Spatie\DataTransferObject\Exceptions\UnknownProperties;

final class CarController extends ApiController
{
    /**
     * @OA\Get(
     *      path="/api/v1/car/all",
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
        return new JsonResponse(
            fractal()
                ->item(app(GetCarsAction::class)->run())
                ->transformWith(new GetCarsTransformer())
                ->toArray()
        );
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
        return new JsonResponse(
            fractal()
                ->item(app(GetCarAction::class)->run(new GetCarDTO(id: $id)))
                ->transformWith(new GetCarTransformer())
                ->toArray()
        );
    }

    /**
     * @OA\Post(
     *      path="/api/v1/car/action/rent",
     *      operationId="carActionRent",
     *      tags={"Car"},
     *      summary="Аренда автомобиля",
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
    public function rent(RentRequest $request): JsonResponse
    {
        $validated = $request->validated();

        return new JsonResponse(
            fractal()
                ->item(app(RentCarAction::class)->run(new RentCarDTO($validated)))
                ->transformWith(new CarRentTransformer())
                ->toArray()
        );
    }

    /**
     * @OA\Post(
     *      path="/api/v1/car/action/unrent",
     *      operationId="carActionUnRent",
     *      tags={"Car"},
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
    public function unRent(UnRentRequest $request): JsonResponse
    {
        $validated = $request->validated();

        return new JsonResponse(
            fractal()
                ->item(app(UnRentCarAction::class)->run(new UnRentCarDTO($validated)))
                ->transformWith(new CarUnRentTransformer())
                ->toArray()
        );
    }
}
