<?php

use Vshepelev\App\Controllers\BracketsController;

return [
    'post' => [
        '/' => [BracketsController::class, 'check'],
    ],
];