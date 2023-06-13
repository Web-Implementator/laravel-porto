<?php

declare(strict_types=1);

namespace App\Ship\Parents\Actions;

abstract class Action
{
    /*** @var string */
    private string $ui;

    /**
     * @param string $ui
     * @return void
     */
    public function init(string $ui): void
    {
        $this->setUi($ui);
    }

    /**
     * @return string
     */
    public function getUi(): string
    {
        return $this->ui;
    }

    /**
     * @param string $ui
     */
    public function setUi(string $ui): void
    {
        $this->ui = $ui;
    }
}
