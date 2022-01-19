<?php

declare(strict_types=1);

namespace App\Infrastructure;

abstract class AbstractHandler implements IHandler
{
    private IHandler $nextHandler;

    public function setNext(IHandler $handler): IHandler
    {
        $this->nextHandler = $handler;
        return $handler;
    }

    public function handle(string $email): ?string
    {
        //if($this->nextHandler){
            //Где-то здесь нужно добавить условие для выхода
           return $this->nextHandler->handle($email);
        //}

        //return null;
    }


}