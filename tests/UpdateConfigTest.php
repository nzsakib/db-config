<?php

namespace Nzsakib\DbConfig;

use Nzsakib\DbConfig\Models\Configuration;
use Nzsakib\DbConfig\Tests\TestCase;

class UpdateConfigTest extends TestCase
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
    public function it_can_update_existing_db_config()
    {
        factory(Configuration::class)->create(['name' => 'facebook', 'value' => 'a client key']);

        $config = $this->config->get();

        $this->assertEquals('a client key', $config['facebook']);

        $this->config->update('facebook', 'changed key');

        $config = $this->config->get();

        $this->assertEquals('changed key', $config['facebook']);
    }
}
