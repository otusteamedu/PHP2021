<?php

return [
    'queue' => [
        'host' => 'rabbitmq',
        'port' => '5672',
        'user' => 'user',
        'pass' => 'password',
        'vhost' => '/',
        'exhange' => 'bank_exchange',
        'queue' => 'codes',
        'consumer' => 'consumer',
        'email' => 'exmple@gmail.com',
    ],
    'providers' => [
        \App\Infrastructure\Providers\DIProvider::class
    ]
];