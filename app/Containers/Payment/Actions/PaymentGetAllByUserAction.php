<?php

declare(strict_types=1);

namespace App\Containers\Payment\Actions;

use App\Containers\Payment\Data\Repositories\PaymentRepository;

use App\Ship\Parents\Actions\Action;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

final class PaymentGetAllByUserAction extends Action
{
    public function __construct(
        protected PaymentRepository $repository
    ) {
    }

    /**
     * @param $id
     * @return AnonymousResourceCollection
     */
    public function run($id): AnonymousResourceCollection
    {
        return $this->repository->getAllByUser($id);
    }
}
