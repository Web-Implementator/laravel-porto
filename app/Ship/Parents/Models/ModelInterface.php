<?php

declare(strict_types=1);

namespace App\Ship\Parents\Models;

interface ModelInterface
{
    /**
     * @return ?string
     */
    public function getPolicyName(): ?string;
}
