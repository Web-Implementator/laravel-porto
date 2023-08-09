<?php

declare(strict_types=1);

namespace App\Ship\Parents\Traits;

use Exception;

trait PolicyTrait
{
    /**
     * @var ?string
     */
    private ?string $policyModel = null;

    /**
     * @return ?string
     */
    public function getPolicyModel(): ?string
    {
        return $this->policyModel;
    }

    /**
     * @param ?string $policyModel
     */
    public function setPolicyModel(?string $policyModel): void
    {
        $this->policyModel = $policyModel;
    }

    /**
     * @return void
     * @throws Exception
     */
    protected function policyRegister(): void
    {
        $policyModel = $this->getPolicyModel();

        if (empty($policyModel)) {
            return;
        }

        $method = app($policyModel);

        if (!method_exists($method, 'getPolicyName')) {
            throw new Exception('The required method is not described in the model getPolicyName');
        }

        $this->authorizeResource($policyModel, $method->getPolicyName());
    }
}
