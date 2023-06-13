<?php

declare(strict_types=1);

namespace App\Containers\User\Data\Transporters;

use App\Ship\Parents\Transporters\Data;

final class GetUserDTO extends Data
{
    public function __construct(
        public int $id,
    ) {
    }

    /**
     * @return int
     */
    public function getPrimaryId(): int
    {
        return $this->id;
    }
}
