<?php

namespace App\Utils;

class ConsoleOutput
{
    public static function info(string $type, string $text): void
    {
        printf('[%s] %s%s', $type, $text, PHP_EOL);
    }
}
