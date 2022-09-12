<?php

namespace App\Application\UseCases;

use App\Application\Contracts\ConsumerInterface;
use App\Application\Contracts\ServiceInterface;
use App\Utils\ConsoleOutput;

class Server implements ServiceInterface
{
    private ConsumerInterface $consumer;

    /**
     * @param ConsumerInterface $consumer
     */
    public function __construct(ConsumerInterface $consumer)
    {
        $this->consumer = $consumer;
    }

    /**
     * @return void
     */
    public function execute(): void
    {
        ConsoleOutput::info('x', 'Awaiting requests. To exit press CTRL + C');
        $this->consumer->execute();
    }
}