<?php

namespace App;

use App\Http\Router;

class App
{
    private $router;

    public function __construct()
    {
        $this->router = new Router();
    }

    public function run()
    {
        $this->router->resolve();
    }
}