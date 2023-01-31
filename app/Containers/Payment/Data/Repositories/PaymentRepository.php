<?php

declare(strict_types=1);

namespace App\Containers\Payment\Data\Repositories;

use App\Containers\Payment\Contracts\PaymentRepositoryInterface;
use App\Containers\Payment\Data\Transporters\GetPaymentDTO;
use App\Containers\Payment\Data\Transporters\PaymentUpdateDTO;
use App\Containers\Payment\Models\PaymentModel;
use App\Containers\Payment\Resources\PaymentResource;
use App\Ship\Parents\Repositories\Repository;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

final class PaymentRepository extends Repository implements PaymentRepositoryInterface
{
    /**
     * @return AnonymousResourceCollection
     */
    public function getAll(): AnonymousResourceCollection
    {
        return PaymentResource::collection(PaymentModel::active()->get());
    }

    /**
     * @param int $user_id
     * @return AnonymousResourceCollection
     */
    public function getAllByUser(int $user_id): AnonymousResourceCollection
    {
        return PaymentResource::collection(PaymentModel::userId($user_id)->active()->get());
    }

    /**
     * @param GetPaymentDTO $dto
     * @return PaymentResource
     */
    public function getByID(GetPaymentDTO $dto): PaymentResource
    {
        return new PaymentResource(PaymentModel::active()->findOrFail($dto->id));
    }

    /**
     * @param array $details
     * @return PaymentResource
     */
    public function create(array $details): PaymentResource
    {
        return new PaymentResource(PaymentModel::create($details));
    }

    /**
     * @param PaymentUpdateDTO $dto
     * @return PaymentResource
     */
    public function update(PaymentUpdateDTO $dto): PaymentResource
    {
        $model = PaymentModel::findOrFail($dto->id);

        $model->fill($dto->details);

        $model->save();

        return new PaymentResource($model);
    }

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id): void
    {
        PaymentModel::destroy($id);
    }
}
