<?php

namespace Nzsakib\DbConfig\Tests;

use Nzsakib\DbConfig\DbConfigServiceProvider;
use Orchestra\Testbench\TestCase as TestbenchTestCase;

class TestCase extends TestbenchTestCase
{
    /**
     * Setup the test environment.
     */
    protected function setUp(): void
    {
        parent::setUp();
        // dd(realpath(__DIR__ . '/../src/database/factories'));
        $this->withFactories(realpath(__DIR__ . '/../src/database/factories'));
        // $this->loadMigrationsFrom(realpath(__DIR__ . '/../src/database/migrations'));
    }

    protected function getPackageProviders($app)
    {
        return [
            DbConfigServiceProvider::class,
        ];
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);

        include_once __DIR__ . '/../src/database/migrations/create_configurations_table.php';
        (new \CreateConfigurationsTable)->up();
    }
}
