<?php

namespace Vshepelev\App\Helpers;

class Console
{
    public static function read(): string
    {
        return trim(fgets(STDIN));
    }

    public static function line(string $message = ''): void
    {
        echo $message . PHP_EOL;
    }

    public static function info(string $message): void
    {
        self::line("Info: {$message}");
    }
}
