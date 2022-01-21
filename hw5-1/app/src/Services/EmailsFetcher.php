<?php

declare(strict_types=1);

namespace App\Services;

use App\Console\Console;

class EmailsFetcher
{
    public function fetch(): array
    {
        $emails = Console::readLines();

        return array_filter($emails);
    }
}