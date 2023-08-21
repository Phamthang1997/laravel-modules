<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Sanctum Lite Time Expiration Minutes
    |--------------------------------------------------------------------------
    |
    | The expiration period of the authentication result in minutes.
    | Authentication flow session duration 3 minutes
    | Refresh token expiration max 43200 minutes ~ 30 days
    | Access token expiration 60 minutes ~ 1 hours
    | ID token expiration 60 minutes ~ 1 hours
    */

    'lifetime' => [
        'session' => env('SANCTUM_SESSION_LIFE_TIME', 3),
        'access' => env('SANCTUM_ACCESS_LIFE_TIME', 180),
        'refresh' => env('SANCTUM_REFRESH_LIFE_TIME', 60 * 24),
        'remember_me_ratio' => env('SANCTUM_REMEMBER_ME_RATIO', 30),
    ],
];
