<?php

namespace App\Application\Contracts;

use App\DTO\EventRequest;
use App\DTO\EventResponse;

interface EventServiceInterface
{
    public function getStatus(string $id): EventResponse;

    public function create(EventRequest $req): EventResponse;

    public function execute(string $id): void;
}
