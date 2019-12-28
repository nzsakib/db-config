<?php

namespace Nzsakib\DbConfig\Tests\Feature;

use Nzsakib\DbConfig\Tests\TestCase;
use Nzsakib\DbConfig\Facades\CustomConfig;
use Nzsakib\DbConfig\Models\Configuration;
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
}
