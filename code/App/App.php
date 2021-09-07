<?php

namespace App;

use App\Models\Databse;
use Core\Router;

class App {
    
    public function run(){

        $database = new Databse();

        $router = new Router();

        
        $router->add('', ['controller' => 'Home', 'action' => 'index']);
        $router->add('messages', ['controller' => 'Messages', 'action' => 'index']);
        $router->add('{controller}/{action}');
        
        $router->dispatch($_SERVER['QUERY_STRING']);

          

    }

}