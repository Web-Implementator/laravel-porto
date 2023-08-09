<?php

declare(strict_types=1);

namespace App\Ship\Parents\Actions;

use App\Ship\Parents\Exceptions\UnknownInterfaceException;
use App\Ship\Parents\Traits\UiTrait;

abstract class Action
{
    use UiTrait;

    /**
     * @param string $ui
     * @return void
     * @throws UnknownInterfaceException
     */
    public function init(string $ui): void
    {
        $this->setUi($ui);
    }
}
