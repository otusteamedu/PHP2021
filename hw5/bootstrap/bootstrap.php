<?php

include __DIR__ . '/../vendor/autoload.php';

/** @var Psr\Container\ContainerInterface $container */
$container = include __DIR__ . '/../dependencies/dependencies.php';

return $container->get(App\Http\Server::class);
