<?php

namespace App\Application\Contracts;

use App\DTO\Request;
use App\DTO\Response;

interface PublisherInterface
{
    public function execute(string $routingKey, Request $req): Response;

    public function close(): void;
}
