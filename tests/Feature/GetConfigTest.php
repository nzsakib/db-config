<?php

namespace Nzsakib\DbConfig\Tests\Feature;

use Nzsakib\DbConfig\Tests\TestCase;

class GetConfigTest extends TestCase
{
    /** @test */
    public function can_get_custom_config_from_container()
    {
        $this->assertIsString(config('facebook'));
    }
}
