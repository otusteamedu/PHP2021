<?php

use League\Container\Container;
use MySite\app\Controllers\IndexController;
use Zend\Diactoros\Response;

$container = new Container();



$container
    ->addServiceProvider(MySite\app\ServiceProvider\ZendDiactorosServiceProvider::class);

return $container;
