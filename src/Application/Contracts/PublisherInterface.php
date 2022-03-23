<?php

namespace App\Application\Contracts;

use App\DTO\EventRequest;
use App\DTO\EventResponse;

interface PublisherInterface
{
    public function execute(string $routingKey, EventRequest $req): EventResponse;
}
