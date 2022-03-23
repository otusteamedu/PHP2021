<?php

namespace App\Application\UseCases;

use App\Application\Contracts\ConsumerInterface;
use App\Application\Contracts\ServiceInterface;
use App\Utils\ConsoleOutput;
use Exception;

class Server implements ServiceInterface
{
    private ConsumerInterface $consumer;

    /**
     * @throws Exception
     */
    public function __construct(ConsumerInterface $consumer)
    {
        $this->consumer = $consumer;
    }

    /**
     * @throws Exception
     */
    public function execute(): void
    {
        ConsoleOutput::info('x', 'Awaiting requests. To exit press CTRL+C');
        $this->consumer->execute();
    }
}
