<?php

declare(strict_types=1);

namespace App\Containers\User\Data\Transporters;

use App\Ship\Abstracts\Transporters\DataAbstract;

final class UserUpdateDTO extends DataAbstract
{
    public function __construct(
        protected int $id,
        protected array $data,
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
