<?php

namespace Nzsakib\DbConfig;

use Nzsakib\DbConfig\Tests\TestCase;
use Nzsakib\DbConfig\Models\Configuration;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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

        $this->config->updateByName('facebook', 'changed key');

        $config = $this->config->get();

        $this->assertEquals('changed key', $config['facebook']);
    }

    /** @test */
    public function it_can_update_existing_db_config_by_id()
    {
        $configModel = factory(Configuration::class)->create(['name' => 'facebook', 'value' => 'a client key']);

        $config = $this->config->get();

        $this->assertEquals('a client key', $config['facebook']);

        $this->config->updateById($configModel->id, 'facebook', 'changed key');

        $config = $this->config->get();

        $this->assertEquals('changed key', $config['facebook']);
    }

    /** @test */
    public function it_throws_exception_if_name_not_found_while_updating_by_name()
    {
        $this->expectException(ModelNotFoundException::class);

        $this->config->updateByName('facebook', 'changed key');
    }

    /** @test */
    public function it_throws_exception_if_id_not_found_while_updating_by_id()
    {
        $this->expectException(ModelNotFoundException::class);

        $this->config->updateById(1, 'facebook', 'changed key');
    }

    private function cacheKey()
    {
        return config('db-config.cache_key', 'app_config');
    }
}
