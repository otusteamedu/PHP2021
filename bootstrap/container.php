<?php
$builder = new \DI\ContainerBuilder();

$builder->addDefinitions([
    \App\Infrastructure\Controllers\FrontController::class => DI\factory(function () {
        return new \App\Infrastructure\Controllers\FrontController(
            new \App\Infrastructure\Models\Auth(),
            new \App\Application\Services\SendEmail(new \App\Application\UseCase\CheckAuthStatus()),
            new \App\Infrastructure\Models\View()
        );
    }),
]);

$builder->useAutowiring(true);
$builder->useAnnotations(true);

return $builder->build();