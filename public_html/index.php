<?php

use App\App;
use App\ProductFactoryInterface;
use App\RecieptIterator;

require_once '../vendor/autoload.php';


$builder = new \DI\ContainerBuilder();

$builder->addDefinitions([
    ProductFactoryInterface::class => DI\factory(function () {
        return new \App\BBQProductFactory();
    }),
    RecieptIterator::class => DI\factory(function () {
        var_dump(123);
        exit();
    }),

]);

$container = $builder->build();

$app = new App();

$app->initialize();