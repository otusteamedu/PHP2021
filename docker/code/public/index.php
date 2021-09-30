<?php

require '../vendor/autoload.php';

use Otus\Route;

echo '<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body><div class="container-fluid ml-4 mr-4">';

try{
    $uri = $_SERVER['REQUEST_URI'];
    $route = new Route($uri);
    $page = $route->renderPage();
}
catch(Exception $e){
    echo "Something is went wrong";
}

echo '</div>
</body>';