<?php

namespace App\Infrastructure\Commands;


use App\Application\Services\CreatedCodeReceiver;


class ReceiveCommand
{
    private $codeReceiverService;

    public function __construct(CreatedCodeReceiver $codeReceiver)
    {
        $this->codeReceiverService = $codeReceiver;
    }

    public function receive()
    {
        $this->codeReceiverService->receive();
    }
}