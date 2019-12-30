<?php

namespace Nzsakib\DbConfig;

use Illuminate\Support\Arr;
use InvalidArgumentException;
use Illuminate\Support\Facades\Cache;
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

    /**
     * Get flattened array of config files
     *
     * @return array
     */
    public function getCachedData(): array
    {
        if (config('db-config.use_cache') && $config = Cache::get($this->cacheKey())) {
            return $config;
        }

        $configs = $this->get();
        $flatted = Arr::dot($configs);

        if (config('db-config.use_cache')) {
            Cache::forever($this->cacheKey(), $flatted);
        }

        return $flatted;
    }

    public function set(string $name, $value)
    {
        $this->mustBeAssociativeArrayWhenMerging($name, $value);

        $this->checkExistingDefaultKeys($name, $value);

        if (Configuration::where('name', $name)->exists()) {
            throw new InvalidArgumentException('Same name configuration exists. Please edit existing config or give it a new name.');
        }

        $newConfig = Configuration::create([
            'name' => $name,
            'value' => $value,
        ]);

        Cache::forget($this->cacheKey());

        return $newConfig;
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

    /**
     * Get Cache key name to store in cache
     *
     * @return string
     */
    private function cacheKey(): string
    {
        return config('db-config.cache_key', 'app_config');
    }
}
