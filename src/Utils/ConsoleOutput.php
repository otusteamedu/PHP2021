<?php

namespace App\Utils;

class ConsoleOutput
{
    /**
     * @param string $type
     * @param string $text
     * @return void
     */
    public static function info(string $type, string $text): void
    {
        printf('[%s] %s%s', $type, $text, PHP_EOL);
    }
}