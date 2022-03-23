<?php

namespace App\Utils;

use App\DTO\EventResponse;

class EventOutput
{
    public static function send(EventResponse $resp): void
    {
        header('Content-Type: application/json; charset=utf-8');
        http_response_code($resp->getCode());
        echo $resp->getMessage();
    }
}
