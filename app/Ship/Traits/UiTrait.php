<?php

declare(strict_types=1);

namespace App\Ship\Traits;

use App\Ship\Core\Exceptions\UnknownInterfaceException;

trait UiTrait
{
    /**
     * @var array|string[]
     */
    private array $uiAvailable = [
        'web',
        'api',
        'cli'
    ];

    /**
     * The type of this controller. This will be accessibly mirrored in the Actions.
     * Giving each Action the ability to modify it's internal business logic based on the UI type that called it.
     */
    private string $ui;

    /**
     * @return string
     */
    public function getUi(): string
    {
        return $this->ui;
    }

    /**
     * @param string $ui
     * @throws UnknownInterfaceException
     */
    public function setUi(string $ui): void
    {
        if (!in_array($ui, $this->uiAvailable)) {
            throw new UnknownInterfaceException('Unknown interface');
        }

        $this->ui = $ui;
    }
}
