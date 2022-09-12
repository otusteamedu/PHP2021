<?php

namespace App\Application\Contracts;

use App\DTO\EventResponse;

interface EventControllerInterface
{
    public const PATH = '/api/v1/event';

    public function get(string $id): EventResponse;

    public function create(): EventResponse;
}