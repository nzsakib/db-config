<?php

namespace Nzsakib\DbConfig;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Nzsakib\DbConfig\Skeleton\SkeletonClass
 */
class DbConfigFacade extends Facade
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
