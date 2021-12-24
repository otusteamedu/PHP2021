<?php

namespace App;

class Response
{
    public static function output(string $message, int $code = 200): void
    {
        http_response_code($code);
        echo $message . PHP_EOL;
    }
}
