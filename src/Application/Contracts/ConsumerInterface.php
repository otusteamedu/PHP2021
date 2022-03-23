<?php

namespace App\Application\Contracts;

interface ConsumerInterface
{
    public const QUEUE_NAME = 'rpc_queue';

    public function execute(): void;
}
