<?php
include "../vendor/autoload.php";

use App\Application\Services\AuthInterface;
use App\Application\Services\ViewMapperInterface;
use \App\Infrastructure\Controllers\FrontController;

$builder = new \DI\ContainerBuilder();

$builder->addDefinitions([
    AuthInterface::class => DI\factory(function () {
        return new \App\Infrastructure\Models\Auth();
    }),
    ViewMapperInterface::class => DI\factory(function () {
        return new \App\Infrastructure\Models\View();
    }),
]);

$builder->useAutowiring(true);
$builder->useAnnotations(true);

return $builder->build();