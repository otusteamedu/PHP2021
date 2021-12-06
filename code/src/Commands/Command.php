<?php

declare(strict_types=1);

namespace Vshepelev\App\Commands;

interface Command
{
    public function run(): void;
}