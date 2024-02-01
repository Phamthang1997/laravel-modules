<?php

return [
    'socialite' => [
        'drivers' => [
            'google' => [
                'client_id'     => env('GOOGLE_CLIENT_ID', '716854690145-vf06gt19hhtk8bg7u7u8gruv2ug0tqat.apps.googleusercontent.com'),
                'client_secret' => env('GOOGLE_CLIENT_SECRET', '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'),
                'redirect'      => env('GOOGLE_REDIRECT', 'http://127.0.0.1/google/calblack'),
            ]
        ],
    ],
];