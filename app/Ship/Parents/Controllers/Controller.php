<?php

declare(strict_types=1);

namespace App\Ship\Parents\Controllers;

use App\Ship\Parents\Traits\UiTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as IlluminateController;

class Controller extends IlluminateController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, UiTrait;

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
}
