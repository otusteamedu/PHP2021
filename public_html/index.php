<?php

use App\App;
use App\Application\ProductFactoryInterface;
use App\Application\Visitors\Visitor;
use App\Domain\VisitorInterface;
use App\Infrastructure\Factories\BBQProductFactory;

require_once '../vendor/autoload.php';


$builder = new \DI\ContainerBuilder();

$builder->addDefinitions(array(
    ProductFactoryInterface::class => DI\factory(function () {
        return new BBQProductFactory();
    }),
    VisitorInterface::class => DI\factory(function () {
        return new Visitor();
    }),


));

$container = $builder->build();

$app = new App();

$app->initialize();