<?php

declare(strict_types=1);

namespace App\Ship\Abstracts\Actions;

use App\Ship\Core\Exceptions\UnknownInterfaceException;
use App\Ship\Traits\UiTrait;

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
