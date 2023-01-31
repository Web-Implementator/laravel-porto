<?php

declare(strict_types=1);

namespace App\Containers\Payment\Contracts;

use App\Containers\Payment\Data\Transporters\GetPaymentDTO;
use App\Containers\Payment\Data\Transporters\PaymentUpdateDTO;
use App\Containers\Payment\Resources\PaymentResource;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

interface PaymentRepositoryInterface
{
    /**
     * @return AnonymousResourceCollection
     */
    public function getAll(): AnonymousResourceCollection;

    /**
     * @param GetPaymentDTO $dto
     * @return PaymentResource
     */
    public function getByID(GetPaymentDTO $dto): PaymentResource;

    /**
     * @param int $user_id
     * @return AnonymousResourceCollection
     */
    public function getAllByUser(int $user_id): AnonymousResourceCollection;

    /**
     * @param array $details
     * @return PaymentResource
     */
    public function create(array $details): PaymentResource;

    /**
     * @param PaymentUpdateDTO $dto
     * @return PaymentResource
     */
    public function update(PaymentUpdateDTO $dto): PaymentResource;

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id): void;
}
