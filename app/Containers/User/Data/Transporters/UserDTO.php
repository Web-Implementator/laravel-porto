<?php

declare(strict_types=1);

namespace App\Containers\User\Data\Transporters;

use App\Ship\Abstracts\Transporters\DataAbstract;

final class UserDTO extends DataAbstract
{
    public function __construct(
        public ?int $userId,
        public ?bool $isActive,
        public ?string $name,
        public ?string $email,
        public ?string $password,
        public ?bool $isCache = true,
    ) {
    }

    /**
     * @return mixed
     */
    public function getPrimaryId(): mixed
    {
        return $this->userId;
    }
}
