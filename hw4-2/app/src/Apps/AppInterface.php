<?php

declare(strict_types=1);

namespace App\Apps;

interface AppInterface
{
    public function start(): void;

    public function stop(): void;
}