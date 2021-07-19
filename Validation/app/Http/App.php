<?php

namespace App\Http;


use App\Http\Controllers\IndexController;
use App\Http\Controllers\MessageController;

class App
{
    public function run()
    {
        Router::init([
            '/' => [IndexController::class, 'index', 'GET'],
            '/send-message' => [MessageController::class, 'checkString', 'POST']
        ]);
    }
}
