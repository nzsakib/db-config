<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Configuration Table
    |--------------------------------------------------------------------------
    |
    | This table keeps all the custom config for the app.
    | You can change the table name to mach the migration file here
    |
    */
    'table_name' => 'configurations',
    /*
    |--------------------------------------------------------------------------
    | Cache key name
    |--------------------------------------------------------------------------
    |
    | This is the cache key name that will be used to cache the custom configs into cache.
    |
    */
    'cache_key' => 'app_config',
    /*
    |--------------------------------------------------------------------------
    | Turn cache on or off
    |--------------------------------------------------------------------------
    |
    | Set it to true if you want to use cache to get the custom config data
    | Or set it to false if you dont want to use cache at all,
    | in that case the custom config will be loaded each time from Database
    |
    */
    'use_cache' => true,
];
