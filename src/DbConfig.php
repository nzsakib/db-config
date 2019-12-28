<?php

namespace Nzsakib\DbConfig;

use Nzsakib\DbConfig\Models\Configuration;

class DbConfig
{
    public function get()
    {
        $configs = Configuration::query()
                ->select('name', 'value')
                ->get()
                ->keyBy('name')
                ->transform(function ($config) {
                    return $config->value;
                })
                ->toArray();

        return $configs;
    }
}
