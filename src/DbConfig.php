<?php

namespace Nzsakib\DbConfig;

use Illuminate\Support\Arr;
use InvalidArgumentException;
use Nzsakib\DbConfig\Models\Configuration;

class DbConfig
{
    /**
     * Get the configuration key value pairs from database to merge with config
     *
     * @return array
     */
    public function get(): array
    {
        return Configuration::query()
                ->select('name', 'value')
                ->get()
                ->keyBy('name')
                ->transform(function ($config) {
                    return $config->value;
                })
                ->toArray();
    }

    public function set(string $name, $value)
    {
        $this->mustBeAssociativeArrayWhenMerging($name, $value);

        $this->checkExistingDefaultKeys($name, $value);

        if (Configuration::where('name', $name)->exists()) {
            throw new InvalidArgumentException('Same name configuration exists. Please edit existing config or give it a new name.');
        }

        return Configuration::create([
            'name' => $name,
            'value' => $value,
        ]);
    }

    /**
     * we dont merge if same key exists in default
     * Check each array key if existing configuration exists with same key
     *
     * @param string $name
     * @param string|array $value
     * @return void
     * @throws InvalidArgumentException
     */
    private function checkExistingDefaultKeys(string $name, $value)
    {
        if (config($name) && is_array($value)) {
            $dotArray = Arr::dot($value);

            foreach ($dotArray as $key => $arrValue) {
                $configName = "{$name}.{$key}";
                if (config($configName)) {
                    throw new InvalidArgumentException('There is an existing config found with name: ' . $configName);
                }
            }
        }
    }

    /**
     * we allow merging with existing config keys
     * 2nd argument must be an associative array when merging with existing config
     *
     * @param string $name
     * @param string|array $value
     * @return void
     * @throws InvalidArgumentException
     */
    protected function mustBeAssociativeArrayWhenMerging(string $name, $value)
    {
        if (config($name) && !is_array($value) || (is_array($value) && !Arr::isAssoc($value))) {
            throw new InvalidArgumentException('Value should be an associative array when merging with existing config.');
        }
    }
}
