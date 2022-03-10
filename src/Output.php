<?php

namespace App;

use App\DTO\Response;

class Output
{
    public static function send(Response $resp): void
    {
        header('Content-Type: application/json; charset=utf-8');
        http_response_code($resp->getCode());
        echo $resp->getMessage();
    }
}
