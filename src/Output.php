<?php

namespace App;

use App\DTO\Response;

class Output
{
    public static function send(Response $resp): void
    {
        http_response_code($resp->getCode());
        echo $resp->getMessage() . PHP_EOL;
    }
}
