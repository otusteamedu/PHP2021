<?php

namespace App;

use App\Infrastructure\RequestHandler;

class Application
{
    private RequestHandler $handler;

    public function __construct()
    {
        $this->handler = new RequestHandler($_POST);
    }

    public function run(): void
    {
        $this->handler->execute();
    }
}
