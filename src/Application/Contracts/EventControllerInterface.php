<?php

namespace App\Application\Contracts;

use App\DTO\Response;

interface EventControllerInterface
{
    public const PATH = '/api/v1/event';

    public function get(string $id): Response;

    public function create(): Response;
}
