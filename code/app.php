<?php

require_once('vendor/autoload.php');

$app = new App\Application('ru');
$arIngredients = $app->run();

require_once 'pages/order.php';
