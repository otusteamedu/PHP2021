<?php

namespace App\Infrastructure\Providers;


use App\Application\DTO\QueueConnectionDTO;
use App\Application\Services\CodeGenerator;
use App\Application\Services\CreatedCodeReceiver;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use function DI\factory;

class DIProvider implements DIProviderInterface
{
    private $definitions = [];

    public function __construct()
    {
        $this->boot();
    }

    public function getDefinitions()
    {
        return $this->definitions;
    }

    private function registerDefinitions() : array
    {
        $queueParams = getConfig('app')['queue'];
        $amqpConnection = new QueueConnectionDTO($queueParams['host'],
            $queueParams['port'],
            $queueParams['user'],
            $queueParams['pass'],
            $queueParams['vhost']);
        return [
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

    public function boot()
    {
        $this->definitions = $this->registerDefinitions();
    }
}