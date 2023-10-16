<?php

use Illuminate\Support\Carbon;

return [

    /*
    |--------------------------------------------------------------------------
    | Package Version
    |--------------------------------------------------------------------------
    |
    | This is the name of the Redis connection where Rate limiter will store the
    | information required for it to function.
    |
    */

    'version' => [
        'assembly' => '0.0.1',
        'file' => '0.0.1',
        'product' => '0.0.1',
    ],
    'information' => [
        'title' => 'laravel modules',
        'description' => '',
        'copyright' => 'All copyright belongs to laravel modules',
        'year' => '1997 - ' . Carbon::now()->year,
        'company' => 'PXT., LTD',
        'guid' => 'ac300600-2dc3-4194-a273-5ffa5871fd66',
        'author' => 'ThangPX'
    ],
];
