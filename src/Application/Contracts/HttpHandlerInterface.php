<?php

namespace App\Application\Contracts;

interface HttpHandlerInterface
{
    public function run(): void;
}