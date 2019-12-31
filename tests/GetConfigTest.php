<?php

namespace Nzsakib\DbConfig;

use Nzsakib\DbConfig\Tests\TestCase;
use Illuminate\Database\Eloquent\Builder;
use Nzsakib\DbConfig\Facades\CustomConfig;
use Nzsakib\DbConfig\Models\Configuration;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GetConfigTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_get_custom_config_from_container()
    {
        factory(Configuration::class)->create([
            'name' => 'twitter',
            'value' => 'thing',
        ]);
        $config = CustomConfig::get();

        $this->assertIsString($config['twitter']);
    }

    /** @test */
    public function it_can_get_one_level_nested_settings_of_a_key()
    {
        factory(Configuration::class)->create([
            'name' => 'facebook',
            'value' => [
                'secret' => 'asdjhakjsdhkjasd',
                'client' => 'asdasdagfdgh',
            ],
        ]);

        $config = CustomConfig::get();

        $this->assertIsString($config['facebook']['secret']);
    }

    /** @test */
    public function it_can_get_two_level_deep_settings()
    {
        factory(Configuration::class)->create([
            'name' => 'guards',
            'value' => [
                'web' => [
                    'driver' => 'token',
                    'provider' => 'users',
                ],
            ],
        ]);

        $config = CustomConfig::get();

        $this->assertCount(2, $config['guards']['web']);
    }

    /** @test */
    public function it_can_get_only_cancated_value()
    {
        $this->withoutExceptionHandling();
        factory(Configuration::class)->create([
            'name' => 'services',
            'value' => [
                'client' => 'client value',
                'secret' => 'secret value',
            ],
        ]);

        $config = CustomConfig::get();

        $this->assertCount(2, $config['services']);
    }

    /** @test */
    public function it_can_get_all_config_from_db_as_collection()
    {
        factory(Configuration::class, 5)->create();

        $collection = CustomConfig::getCollection();

        $this->assertInstanceOf(Collection::class, $collection);
        $this->assertCount(5, $collection);
    }

    /** @test */
    public function it_can_get_eloquent_query_builder_to_run_custom_query()
    {
        $this->assertInstanceOf(Builder::class, CustomConfig::getQuery());
    }
}
