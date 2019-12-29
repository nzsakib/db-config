<?php

namespace Nzsakib\DbConfig\Tests\Feature;

use Nzsakib\DbConfig\Tests\TestCase;

class AdminPanelTest extends TestCase
{
    /** @test */
    public function it_can_see_admin_dashboard()
    {
        $this->get('/test')->assertSee('hello world');
    }
}
