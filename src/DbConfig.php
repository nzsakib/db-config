<?php

namespace Nzsakib\DbConfig;

use InvalidArgumentException;
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

    public function set(string $name, $value, bool $concat = false)
    {
        if (config($name) && !$concat) {
            throw new InvalidArgumentException('There is an existing config found with name: ' . $name);
        }

        if (config($name) && !is_array($value) && $concat) {
            throw new InvalidArgumentException('Value should be an array.');
        }

        return Configuration::create([
            'name' => $name,
            'value' => $value,
            'concat' => $concat,
        ]);
    }
}
