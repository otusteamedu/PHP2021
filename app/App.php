<?php

namespace App;

class App
{
    public function run($container)
    {

        $route = $container->get('App\Route');
        $route->route($container);

    }

}