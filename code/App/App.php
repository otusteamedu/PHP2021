<?php

namespace App;

use App\Models\Databse;
use Core\Router;

class App {
    
    public function run(){

        $database = new Databse();
        $router = new Router();

    }

}