<?php

return [

    /**
     * The table name to be used to store settings in the database.
     */
    'database_table_name' => '_settings',

    /**
     * The duration of the setting cache. Default is 1 month.
     * Note that from Laravel 5.8, the cache duration is denoted in seconds instead of minutes.
     * For Laravel 5.8 and above, use 60*60*24*30 for 1 month.
     */
    'cache_duration' => 60*60*24*30,

    /**
     * The prefix to be used for storing a cache.
     * Caches will be stored as "<prefix>.<setting key>"
     * Eg. setting.app_environment
     * This value should be string only.
     */
    'cache_prefix' => 'setting',

];