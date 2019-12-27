<?php

namespace Nzsakib\DbConfig;

use Nzsakib\DbConfig\Models\Configuration;

class DbConfig
{
    public function get()
    {
        $configs = Configuration::pluck('name')->toArray();

        config([
            'facebook' => 'thing',
        ]);
    }
}
