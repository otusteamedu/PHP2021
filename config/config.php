<?php

use App\Application\Contracts\BankStatementServiceInterface;
use App\Application\Contracts\ConsumerInterface;
use App\Application\Contracts\MailerInterface;
use App\Application\Contracts\PublisherInterface;
use App\Application\UseCases\BankStatementService;
use App\Infrastructure\Consumer;
use App\Infrastructure\Mailer;
use App\Infrastructure\Publisher;
use PhpAmqpLib\Connection\AMQPStreamConnection;

$rmqConnectionHelper = DI\create(AMQPStreamConnection::class)->constructor(
    getenv('LOCAL_HOST'),
    getenv('RABBITMQ_PORT'),
    getenv('RABBITMQ_USER'),
    getenv('RABBITMQ_PASS')
);

return [
    AMQPStreamConnection::class          => $rmqConnectionHelper,
    BankStatementServiceInterface::class => DI\get(BankStatementService::class),
    ConsumerInterface::class             => DI\get(Consumer::class),
    PublisherInterface::class            => DI\get(Publisher::class),
    MailerInterface::class               => DI\get(Mailer::class),
];
