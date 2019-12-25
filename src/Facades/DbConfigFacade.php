<?php

namespace Nzsakib\DbConfig\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Nzsakib\DbConfig\DbConfig
 */
class DbConfig extends Facade
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
