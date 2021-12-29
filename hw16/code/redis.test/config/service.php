<?php
return [
    'passport' => [
        'login_endpoint' => env('PASSPORT_LOGIN_ENDPOINT'),
        'client_id' => env('PASSPORT_CLIENT_ID'),
        'client_secret' => env('PASSPORT_CLIENT_SECRET'),
        'grant_type' => env('PASSPORT_GRANT_TYPE'),
        'expiration_time' => env('PASSPORT_TOKEN_EXPIRATION_TIME', 1),//hours
    ],
];
