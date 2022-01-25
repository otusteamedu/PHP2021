<?php

declare(strict_types=1);

namespace App\Infrastructure;

interface IHandler
{
    public function setNext(IHandler $handler): IHandler;
    public function handle (string $email): void;
}