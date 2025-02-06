<?php

namespace App\Application\Interfaces;

interface ConsumerInterface
{
    public function runFromQueue(string $queueName): array;

    public function closeConnection(): void;
}
