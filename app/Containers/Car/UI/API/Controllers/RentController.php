<?php

declare(strict_types=1);

namespace App\Containers\Car\UI\API\Controllers;

use App\Containers\Car\Actions\RentGetByAction;
use App\Containers\Car\Actions\RentGetAllAction;
use App\Containers\Car\Actions\RentCarAction;
use App\Containers\Car\Actions\UnRentCarAction;
use App\Containers\Car\Data\Transporters\RentDTO;
use App\Containers\Car\Models\RentModel;
use App\Containers\Car\UI\API\Requests\RentRequest;
use App\Containers\Car\UI\API\Requests\UnRentRequest;
use App\Ship\Abstracts\Controllers\ApiController;
use Illuminate\Http\JsonResponse;
use OpenApi\Annotations as OA;

final class RentController extends ApiController
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
        return RentModel::class;
    }

    /**
     * @OA\Get(
     *      path="/api/v1/car/rent/getAll",
     *      operationId="carRentGetAll",
     *      tags={"Rent"},
     *      summary="Получить все аренды",
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
     */
    public function getAll(): JsonResponse
    {
        return $this->response($this->action(RentGetAllAction::class, RentDTO::from([])));
    }

    /**
     * @OA\Get(
     *      path="/api/v1/car/rent/{id}",
     *      operationId="carRentGetById",
     *      tags={"Rent"},
     *      summary="Получить аренду по ID",
     *
     *      @OA\Parameter(
     *          description="ID Rent",
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
     */
    public function getById(int $id): JsonResponse
    {
        $response['data'] = $this->action(RentGetByAction::class, RentDTO::from(['rentId' => $id]));

        return $this->response($response);
    }

    /**
     * @OA\Post(
     *      path="/api/v1/car/rent/begin",
     *      operationId="carRentBegin",
     *      tags={"Rent"},
     *      summary="Начать аренду автомобиля",
     *
     *      @OA\Parameter(
     *          name="carId",
     *          in="query",
     *          required=true,
     *
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
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
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Service Unavailable",
     *
     *          @OA\MediaType(
     *           mediaType="application/json",
     *          )
     *      ),
     *  )
     */
    public function begin(RentRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $resource = $this->action(RentCarAction::class, RentDTO::from($validated));

        $response['data'] = $resource;

        $response = $this->addMessage($response, 'Вы успешно арендовали автомобиль');

        return $this->response($response);
    }

    /**
     * @OA\Post(
     *      path="/api/v1/car/rent/end",
     *      operationId="carRentEnd",
     *      tags={"Rent"},
     *      summary="Завершить аренду автомобиля",
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
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Service Unavailable",
     *
     *          @OA\MediaType(
     *           mediaType="application/json",
     *          )
     *      ),
     *  )
     */
    public function end(UnRentRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $resource = $this->action(UnRentCarAction::class, RentDTO::from($validated));

        $response['data'] = $resource;

        $response = $this->addMessage($response, 'Вы успешно завершили аренду');

        return $this->response($response);
    }
}
