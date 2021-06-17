<?php

namespace App;

use Laminas\Diactoros\ServerRequestFactory;
use Middlewares\Utils\Dispatcher;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;

class Server
{
    /**
     * @param MiddlewareInterface[] $middlewareStack
     */
    public function __construct(
        private array $middlewareStack
    ){
    }

    public function run(): ResponseInterface
    {
        return Dispatcher::run($this->middlewareStack, ServerRequestFactory::fromGlobals());
    }
}