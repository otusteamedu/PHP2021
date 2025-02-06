<?php

namespace App\Application\Interfaces;

interface PublisherInterface
{
    public function addToQueue(array $request, string $queueName): bool;

    public function closeConnection(): void;
}
