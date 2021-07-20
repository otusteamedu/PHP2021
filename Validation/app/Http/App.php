<?php

namespace App\Http;


use App\Http\Controllers\IndexController;
use App\Http\Controllers\MessageController;

class App
{
    /**
     * @throws \App\Exception\InvalidMethodException
     */
    public function run()
    {
        (new  Router())->init([
            '/' => [IndexController::class, 'index', 'GET'],
            '/send-message' => [MessageController::class, 'checkString', 'POST']
        ]);
    }
}
