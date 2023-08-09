<?php

declare(strict_types=1);

namespace App\Ship\Abstracts\Controllers;

use App\Ship\Core\Exceptions\UnknownInterfaceException;
use App\Ship\Traits\ApiResponseTrait;
use Exception;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *      version="1.2.1",
 *      title="Integration Swagger in Laravel 10",
 *      description="Implementation of Swagger with in Laravel 10",
 *      @OA\Contact(
 *          email="slava.akulov.1996@gmail.com"
 *      ),
 * )
 * @OA\Server(
 *      url=L5_SWAGGER_CONST_HOST,
 *      description="Demo API Server"
 * )
 */
abstract class ApiController extends ControllerAbstract
{
    use ApiResponseTrait;

    /**
     * @throws UnknownInterfaceException
     * @throws Exception
     */
    public function __construct()
    {
        $this->setUi('api');

        // Description of the logic inside the final controller
        $this->setPolicyModel($this->initPolicyModel());

        // Register policy
        $this->policyRegister();
    }

    /**
     * Initialize policies
     *
     * @see \App\Ship\Abstracts\Controllers\Controller
     * @return ?string
     */
    abstract protected function initPolicyModel(): ?string;
}
