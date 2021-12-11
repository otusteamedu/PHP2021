<?php

use Vshepelev\App\Controllers\BracketsController;
use Vshepelev\App\Controllers\InfrastructureController;

return [
    'post' => [
        '/' => [BracketsController::class, 'check'],
    ],
    'get' => [
        '/session' => [InfrastructureController::class, 'getSessionInfo'],
        '/cache/set' => [InfrastructureController::class, 'setToCache'],
        '/cache/get' => [InfrastructureController::class, 'getFromCache'],
    ],
];
