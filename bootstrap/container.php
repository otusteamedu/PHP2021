<?php
include "../vendor/autoload.php";

use \App\Infrastructure\Controllers\FrontController;

$builder = new \DI\ContainerBuilder();

$builder->addDefinitions([
//    FrontController::class => DI\factory(function () {
//        return new FrontController
//        (
//            new \App\Infrastructure\Models\Auth(),
//            new \App\Application\Services\SendEmail(new \App\Application\UseCase\CheckAuthStatus()),
//            new \App\Infrastructure\Models\View()
//        );
//    }),
]);

$builder->useAutowiring(true);
$builder->useAnnotations(true);

return $builder->build();