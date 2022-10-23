<?php

declare(strict_types=1);

namespace App\Ship\Parents\Tests\PhpUnit;

use App\Ship\Generic\Traits\CreatesApplication;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
}
