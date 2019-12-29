<?php

namespace Nzsakib\DbConfig\Tests\Feature;

use Nzsakib\DbConfig\Tests\TestCase;
use Nzsakib\DbConfig\Facades\CustomConfig;
use Illuminate\Foundation\Testing\RefreshDatabase;
use InvalidArgumentException;
use Nzsakib\DbConfig\DbConfig;

class SetConfigTest extends TestCase
{
    use RefreshDatabase;

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
    public function set_a_config()
    {
        $config = new DbConfig;

        $config->set('mails', 'database');

        $this->assertDatabaseHas('configurations', [
            'name' => 'mails',
            'value' => json_encode('database'),
        ]);

        $data = [
            'client_id' => 'aksdhkj21h3k',
            'client_secret' => 'asdasdasdasd',
        ];

        $config->set('facebook', $data);

        $this->assertDatabaseHas('configurations', [
            'name' => 'facebook',
            'value' => json_encode($data),
        ]);
    }

    /** @test */
    public function it_does_not_overwrite_existing_configuration()
    {
        $this->expectException(InvalidArgumentException::class);

        $this->config->set('auth', 'overwriting');
    }

    /** @test */
    public function it_can_concat_with_existing_configuration()
    {
        $this->config->set('services', ['custom' => 'key'], true);

        $this->assertDatabaseHas('configurations', [
            'name' => 'services',
            'concat' => true,
        ]);

        $this->expectException(InvalidArgumentException::class);

        $this->config->set('services', 'a random string', true);
    }

    /** @test */
    public function it_can_concat_only_with_associative_array()
    {
        $this->expectException(InvalidArgumentException::class);

        $this->config->set('services', ['this should not be accepted'], true);
    }

    /** @test */
    public function it_cannot_merge_exising_key()
    {
        $this->expectException(InvalidArgumentException::class);

        $this->config->set('mail', [
            'driver' => 'existing keys overwriting, should fail',
        ], true);
    }
}
