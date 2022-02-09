<?php

namespace App\Infrastructure\Providers;


use App\Application\DTO\QueueConnectionDTO;
use App\Application\Services\CodeGenerator;
use App\Application\Services\CreatedCodeReceiver;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use function DI\factory;

class DIProvider
{
    private $definitions = [];

    public function getDefinitions()
    {
        return $this->definitions;
    }

    public function register()
    {
        $queueParams = getConfig('app')['queue'];
        $amqpConnection = new QueueConnectionDTO($queueParams['host'],
            $queueParams['port'],
            $queueParams['user'],
            $queueParams['pass'],
            $queueParams['vhost']);
        $this->definitions = [
            AMQPStreamConnection::class => factory(function () use ($amqpConnection) {
                return $amqpConnection;
            }),
            CodeGenerator::class => factory(function () use ($amqpConnection) {
                $queueParams = getConfig('app')['queue'];
                return new CodeGenerator($amqpConnection, $queueParams['exhange'], $queueParams['queue']);
            }),
            CreatedCodeReceiver::class => factory(function () use ($amqpConnection) {
                $queueParams = getConfig('app')['queue'];
                return new CreatedCodeReceiver($amqpConnection, $queueParams['exhange'], $queueParams['queue'], $queueParams['consumer']);
            })
        ];
    }
}