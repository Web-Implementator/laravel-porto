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

use App\Ship\Generic\Controllers\ApiController;
use App\Ship\Generic\Transformers\Serializers\ArraySerializer;

use JsonResponse;
use Throwable;
use Exception;

final class CarController extends ApiController
{
    /**
     * @OA\Get(
     *      path="/api/v1/cars",
     *      operationId="getCars",
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
        try {
            return new JsonResponse(
                fractal()
                    ->item(app(GetCarsAction::class)->run())
                    ->transformWith(new GetCarsTransformer())
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
     *      path="/api/v1/car/{id}",
     *      operationId="getCarById",
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
     */
    public function getById(int $id): JsonResponse
    {
        try {
            return new JsonResponse(
                fractal()
                    ->item(app(GetCarAction::class)->run(new GetCarDTO(id: $id)))
                    ->transformWith(new GetCarTransformer())
                    ->serializeWith(new ArraySerializer())
                    ->toArray()
            );
        } catch (Throwable $e) {
            report($e);
            return $this->responseServiceUnavailable();
        }
    }

    /**
     * @OA\Post(
     *      path="/api/v1/car/action/rent",
     *      operationId="carRent",
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
     */
    public function rent(RentRequest $request): JsonResponse
    {
        try {
            $validated = $request->validated();

            return new JsonResponse(
                fractal()
                    ->item(app(RentCarAction::class)->run(new RentCarDTO($validated)))
                    ->transformWith(new CarRentTransformer())
                    ->serializeWith(new ArraySerializer())
                    ->toArray()
            );
        } catch (Exception $e) {
            return new JsonResponse([
                'message' => [
                    'type' => 'error',
                    'text' => $e->getMessage()
                ]
            ]);
        } catch (Throwable $e) {
            report($e);
            return $this->responseServiceUnavailable();
        }
    }

    /**
     * @OA\Post(
     *      path="/api/v1/car/action/unrent",
     *      operationId="carUnRent",
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
     */
    public function unrent(UnRentRequest $request): JsonResponse
    {
        try {
            $validated = $request->validated();

            return new JsonResponse(
                fractal()
                    ->item(app(UnRentCarAction::class)->run(new UnRentCarDTO($validated)))
                    ->transformWith(new CarUnRentTransformer())
                    ->serializeWith(new ArraySerializer())
                    ->toArray()
            );
        } catch (Exception $e) {
            return new JsonResponse([
                'message' => [
                    'type' => 'error',
                    'text' => $e->getMessage()
                ]
            ]);
        } catch (Throwable $e) {
            report($e);
            return $this->responseServiceUnavailable();
        }
    }
}
