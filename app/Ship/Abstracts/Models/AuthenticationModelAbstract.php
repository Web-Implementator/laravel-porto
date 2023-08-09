<?php

declare(strict_types=1);

namespace App\Ship\Abstracts\Models;

use App\Ship\Contracts\ModelInterface;
use Illuminate\Foundation\Auth\User as Authentication;

class AuthenticationModelAbstract extends Authentication implements ModelInterface
{
    /**
     * @return ?string
     */
    public function getPolicyName(): ?string
    {
        return 'user';
    }
}
