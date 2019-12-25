<?php

namespace Nzsakib\DbConfig\Tests;

use Nzsakib\DbConfig\DbConfigServiceProvider;
use Orchestra\Testbench\TestCase as TestbenchTestCase;

class TestCase extends TestbenchTestCase
{
    protected function getPackageProviders($app)
    {
        return [
            DbConfigServiceProvider::class,
        ];
    }
}
