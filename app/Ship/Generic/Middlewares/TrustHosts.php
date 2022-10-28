<?php

declare(strict_types=1);

namespace App\Ship\Generic\Middlewares;

use App\Ship\Parents\Middlewares\TrustHostsMiddleware;

final class TrustHosts extends TrustHostsMiddleware
{
    /**
     * Get the host patterns that should be trusted.
     *
     * @return array<int, string|null>
     */
    public function hosts(): array
    {
        return [
            $this->allSubdomainsOfApplicationUrl(),
        ];
    }
}
