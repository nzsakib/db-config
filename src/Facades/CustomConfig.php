<?php

namespace Nzsakib\DbConfig\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static array get()
 * @method static array getCachedData()
 * @method static \Illuminate\Database\Eloquent\Builder getQuery()
 * @method static \Illuminate\Database\Eloquent\Collection getCollection()
 * @method static \Nzsakib\DbConfig\Models\Configuration set(string $name, $value)
 * @method static \Nzsakib\DbConfig\Models\Configuration updateById($id, string $name, $newValue)
 * @method static \Nzsakib\DbConfig\Models\Configuration updateByName(string $name, $newValue)
 * @method static \Nzsakib\DbConfig\Models\Configuration deleteByName(string $name)
 * @method static \Nzsakib\DbConfig\Models\Configuration deleteById($id)
 *
 * @see \Nzsakib\DbConfig\DbConfig
 */
class CustomConfig extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'db-config';
    }
}
