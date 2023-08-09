<?php

declare(strict_types=1);

namespace App\Ship\Parents\Controllers;

use App\Ship\Generic\Exceptions\PolicyException;
use App\Ship\Parents\Traits\PolicyTrait;
use App\Ship\Parents\Traits\UiTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as IlluminateController;

class Controller extends IlluminateController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, UiTrait, PolicyTrait;

    /**
     * @param string $method
     * @param ?object $dto
     * @return mixed
     */
    public function action(string $method, object $dto = null): mixed
    {
        $method = app($method);

        $method->init($this->getUi());

        return $method->run($dto);
    }

    /**
     * Checking access Web to the declared model
     *
     * @param mixed $argument
     * @return void
     */
    public function pageAccessCheck(mixed $argument): void
    {
        // Authorization check just in case
        if (!auth()->check()) {
            abort(401);
        }

        // Checking access rights
        if (!auth()->user()->can('view', $argument)) {
            abort(403);
        }
    }

    /**
     * Checking access API to the declared model
     *
     * @param mixed $argument
     * @return void
     * @throws PolicyException
     */
    public function requestAccessCheck(mixed $argument): void
    {
        // Authorization check just in case
        if (!auth()->check()) {
            throw new PolicyException('You are not authorized');
        }

        // Checking access rights
        if (!auth()->user()->can('requestApi', $argument)) {
            throw new PolicyException('You do not have sufficient rights to access');
        }
    }
}
