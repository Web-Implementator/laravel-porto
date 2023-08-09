<?php

declare(strict_types=1);

namespace App\Containers\User\Data\Transporters;

use App\Ship\Abstracts\Transporters\DataAbstract;

final class GetUserDTO extends DataAbstract
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
