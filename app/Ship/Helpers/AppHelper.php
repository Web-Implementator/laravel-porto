<?php

/**
 * @return bool
 */
function isLocal(): bool
{
    return env('APP_ENV') === 'local';
}

/**
 * @return bool
 */
function isProd(): bool
{
    return env('APP_ENV') === 'production';
}
