<?php

declare(strict_types=1);

namespace App\Infrastructure;

abstract class AbstractHandler implements IHandler
{
    private ?IHandler $nextHandler = null;

    public function setNext(IHandler $handler): IHandler
    {
        $this->nextHandler = $handler;
        return $handler;
    }

    public function handle(string $email): void
    {
        if($this->nextHandler !== null){
           $this->nextHandler->handle($email);
        }
    }


}