<?php

namespace App\Application\Contracts;

use App\DTO\Request;
use App\DTO\Response;

interface EventServiceInterface
{
    public function getStatus(string $id): Response;

    public function create(Request $req): Response;

    public function execute(string $id): void;
}
