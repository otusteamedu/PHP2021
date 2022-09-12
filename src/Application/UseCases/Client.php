<?php

namespace App\Application\UseCases;

use App\Application\Contracts\HttpHandlerInterface;
use App\Application\Contracts\ServiceInterface;

class Client implements ServiceInterface
{
    private HttpHandlerInterface $handler;

    /**
     * @param HttpHandlerInterface $handler
     */
    public function __construct(HttpHandlerInterface $handler)
    {
        $this->handler = $handler;
    }

    /**
     * @return void
     */
    public function execute(): void
    {
        $this->handler->run();
    }
}