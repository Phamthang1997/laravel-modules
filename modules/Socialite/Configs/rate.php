<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Rate Limiters Services
    |--------------------------------------------------------------------------
    |
    | This is the name of the Redis connection where Rate limiter will store the
    | information required for it to function.
    |
    */

    'limit' => [
        'name' => 'api',
        'attempts' => [
            'minutes' => 60,
            'hour' => 1,
            'day' => 1,
        ],
    ],
];
