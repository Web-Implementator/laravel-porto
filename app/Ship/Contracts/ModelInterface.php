<?php

declare(strict_types=1);

namespace App\Ship\Contracts;

interface ModelInterface
{
    /**
     * @return ?string
     */
    public function getPolicyName(): ?string;
}
