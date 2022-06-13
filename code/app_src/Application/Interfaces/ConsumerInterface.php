<?php

namespace App\Application\Interfaces;

interface ConsumerInterface
{
    public function runFromQueue(string $queueName): void;

    public function closeConnection(): void;
}
