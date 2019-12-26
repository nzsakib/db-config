<?php

namespace Nzsakib\DbConfig\Tests\Feature;

use Nzsakib\DbConfig\Tests\TestCase;
use Nzsakib\DbConfig\Models\Configuration;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GetConfigTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_get_custom_config_from_container()
    {
        $post = factory(Configuration::class)->create();
        dd($post);
        $this->assertIsString(config('facebook'));
    }
}
