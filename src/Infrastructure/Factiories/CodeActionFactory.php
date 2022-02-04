<?php


namespace App\Infrastructure\Factiories;


use App\Application\Services\AbstractCodeAction;
use App\Application\Services\CodeGenerator;
use App\Application\Services\CreatedCodeReceiver;

class CodeActionFactory
{
    public function createGenerator($connection, $exchange, $queue)
    {
        global $app;
        return new CodeGenerator($connection, $exchange, $queue);
    }

    public function createReceiver($connection, $exchange, $queue, $consumer)
    {
        global $app;
        return new CreatedCodeReceiver($connection, $exchange, $queue, $consumer);
    }
}