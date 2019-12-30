<?php

namespace Nzsakib\DbConfig\Tests\Feature;

use Nzsakib\DbConfig\DbConfig;
use Nzsakib\DbConfig\Tests\TestCase;
use Illuminate\Support\Facades\Cache;
use Nzsakib\DbConfig\Models\Configuration;

class CacheTest extends TestCase
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

    protected function tearDown()
    {
        cache()->forget($this->cacheKey());
    }

    /** @test */
    public function it_can_cache_flatten_config_array()
    {
        factory(Configuration::class)->create(['name' => 'facebook', 'value' => 'a key']);

        $configs = $this->config->getCachedData();

        $this->assertNotNull($configs['facebook']);

        $cached = cache()->get($this->cacheKey());

        $this->assertNotNull($cached['facebook']);
    }

    /** @test */
    public function it_will_not_cache_any_data_from_get_method()
    {
        factory(Configuration::class)->create(['name' => 'facebook', 'value' => 'a key']);

        $configs = $this->config->get();

        $this->assertNotNull($configs['facebook']);

        $this->assertNull(cache()->get($this->cacheKey()));
    }

    /** @test */
    public function it_invalidate_the_cache_when_set_any_new_config_data()
    {
        factory(Configuration::class)->create(['name' => 'facebook', 'value' => 'a key']);

        $configs = $this->config->getCachedData();

        $this->assertNotNull($configs['facebook']);

        $this->config->set('twitter', 'twitter thing');

        $this->assertFalse(cache()->has($this->cacheKey()));
    }

    private function cacheKey()
    {
        return config('db-config.cache_key', 'app_config');
    }
}
