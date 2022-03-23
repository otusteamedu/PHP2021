<?php

namespace App\Application\UseCases;

use App\Application\Contracts\HttpHandlerInterface;
use App\Application\Contracts\ServiceInterface;
use Exception;

class Client implements ServiceInterface
{
    private HttpHandlerInterface $handler;

    /**
     * @throws Exception
     */
    public function __construct(HttpHandlerInterface $handler)
    {
        $this->handler = $handler;
    }

    /**
     * @throws Exception
     */
    public function execute(): void
    {
        $this->handler->run();
    }
}
