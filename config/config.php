<?php

use App\Application\Contracts\ConsumerInterface;
use App\Application\Contracts\EventControllerInterface;
use App\Application\Contracts\EventRepositoryInterface;
use App\Application\Contracts\EventServiceInterface;
use App\Application\Contracts\HttpHandlerInterface;
use App\Application\Contracts\PublisherInterface;
use App\Application\Contracts\ServiceInterface;
use App\Application\UseCases\Client;
use App\Application\UseCases\EventService;
use App\Application\UseCases\Server;
use App\Infrastructure\EventController;
use App\Infrastructure\EventRepository;
use App\Infrastructure\HttpHandler;
use App\Infrastructure\Publisher;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use App\Infrastructure\Consumer;

$rmqConnectionHelper = DI\create(AMQPStreamConnection::class)
    ->constructor(
        getenv('LOCAL_HOST'),
        getenv('RABBITMQ_PORT'),
        getenv('RABBITMQ_USER'),
        getenv('RABBITMQ_PASS')
    );

$options = getopt('', ['type:']);

$serviceClass = ($options['type'] === ServiceInterface::CLIENT) ? Client::class : Server::class;

return [
    AMQPStreamConnection::class         => $rmqConnectionHelper,
    HttpHandlerInterface::class         => DI\get(HttpHandler::class),
    EventControllerInterface::class     => DI\get(EventController::class),
    EventRepositoryInterface::class     => DI\get(EventRepository::class),
    EventServiceInterface::class        => DI\get(EventService::class),
    ConsumerInterface::class            => DI\get(Consumer::class),
    PublisherInterface::class           => DI\get(Publisher::class),
    ServiceInterface::class             => DI\get($serviceClass)
];