<?php

namespace App\Application\Interfaces;

interface PublisherInterface
{
    public function addToQueue(array $request, string $queueName): string;

    public function closeConnection(): void;
}