<?php

declare(strict_types=1);

namespace App\Ship\Parents\Middlewares;

use Illuminate\Http\Middleware\TrustHosts as IlluminateTrustHosts;

final class TrustHosts extends IlluminateTrustHosts
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
