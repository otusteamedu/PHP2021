<?php

$containerBuilder = new DI\ContainerBuilder();

$dependencies = [
    \Redis::class => function(Psr\Container\ContainerInterface $c) {
        return App\Factory\RedisFactory::create($c->get('redis'));
    },
    App\Event\EventRepositoryInterface::class => DI\autowire(App\Event\Repository\RedisEventRepository::class),
    'Server\Event\Endpoint\HttpHandler::create' => [
        DI\autowire(App\Event\Endpoint\HttpHandler::class),
        'create'
    ],
    'Server\Event\Endpoint\HttpHandler::findAllByConditions' => [
        DI\autowire(App\Event\Endpoint\HttpHandler::class),
        'findAllByConditions'
    ],
    'Server\Event\Endpoint\HttpHandler::findOneByConditionsWithHighestScore' => [
        DI\autowire(App\Event\Endpoint\HttpHandler::class),
        'findOneByConditionsWithHighestScore'
    ],
    'Server\Event\Endpoint\HttpHandler::deleteAllEventsByConditions' => [
        DI\autowire(App\Event\Endpoint\HttpHandler::class),
        'deleteAllEventsByConditions'
    ],
    'Server\Event\Endpoint\HttpHandler::deleteOneEvent' => [
        DI\autowire(App\Event\Endpoint\HttpHandler::class),
        'deleteOneEvent'
    ],
    'Server\Event\Endpoint\HttpHandler::flush' => [
        DI\autowire(App\Event\Endpoint\HttpHandler::class),
        'flush'
    ],
];

$containerBuilder->addDefinitions(
    \yaml_parse_file(__DIR__ . '/../configs/config.yml'),
    $dependencies,
);

return $containerBuilder->build();
