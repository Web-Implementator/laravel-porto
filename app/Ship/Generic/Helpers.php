<?php

function isLocal(): bool
{
    return env('APP_ENV') === 'local';
}

function isProd(): bool
{
    return env('APP_ENV') === 'production';
}
