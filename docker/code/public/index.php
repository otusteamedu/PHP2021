<?php

require '../vendor/autoload.php';

use Otus\Route;

try{
    $uri = $_SERVER['REQUEST_URI'];
    $route = new Route($uri);
    $page = $route->renderPage();
}
catch(Exception $e){
    echo "Something is went wrong";
}