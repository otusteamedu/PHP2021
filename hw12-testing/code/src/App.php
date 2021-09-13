<?php

namespace App;

use Repetitor202\routes\Router;

class App
{
    private Router $router;

    public function __construct()
    {
        $this->router = new Router();
    }

    public function run(): void
    {
        $this->router->getResponse();
    }
}