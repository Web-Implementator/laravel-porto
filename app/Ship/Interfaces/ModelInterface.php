<?php

declare(strict_types=1);

namespace App\Ship\Interfaces;

interface ModelInterface
{
    /**
     * @return ?string
     */
    public function getPolicyName(): ?string;
}
