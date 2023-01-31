<?php

declare(strict_types=1);

namespace App\Containers\Payment\UI\API\Controllers;

use App\Containers\Payment\Actions\PaymentGetAllByUserAction;
use App\Ship\Parents\Controllers\ApiController;

use Illuminate\Http\JsonResponse;

use Spatie\DataTransferObject\Exceptions\UnknownProperties;

final class PaymentController extends ApiController
{
    /**
     * @OA\Get(
     *      path="/api/v1/payment/user/{id}",
     *      operationId="paymentGetAllByUser",
     *      tags={"Payment"},
     *      summary="Получить список платежей пользователя",
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
     *  @param int $id
     *  @return JsonResponse
     */
    public function getAllByUser(int $id): JsonResponse
    {
        return response()->json(app(PaymentGetAllByUserAction::class)->run($id));
    }
}
