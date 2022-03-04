<?php

namespace App\Application;

use App\DTO\Response;

interface EventControllerInterface
{
    public const PATH = '/api/v1/event';

    public function get(): Response;

    public function create(): Response;

    public function delete(): Response;
}
