<?php

namespace Nzsakib\DbConfig;

use Nzsakib\DbConfig\Tests\TestCase;
use Nzsakib\DbConfig\Models\Configuration;

class DeleteConfigTest extends TestCase
{
    /**
     * @var \Nzsakib\DbConfig\DbConfig
     */
    private $config;

    public function __construct()
    {
        parent::__construct();

        $this->config = new DbConfig;
    }

    /** @test */
    public function it_can_delete_config_from_db_by_id()
    {
        $config = factory(Configuration::class)->create(['name' => 'facebook', 'value' => 'a client key']);

        $this->assertDatabaseHas(config('db-config.table_name'), ['id' => $config->id]);
        $this->config->deleteById($config->id);

        $this->assertDatabaseMissing(config('db-config.table_name'), ['id' => $config->id]);
    }

    /** @test */
    public function it_can_delete_config_from_db_by_name()
    {
        $config = factory(Configuration::class)->create(['name' => 'facebook', 'value' => 'a client key']);

        $this->assertDatabaseHas(config('db-config.table_name'), ['id' => $config->id]);
        $this->config->deleteByName($config->name);

        $this->assertDatabaseMissing(config('db-config.table_name'), ['id' => $config->id]);
    }
}
