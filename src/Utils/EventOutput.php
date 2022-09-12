<?php

namespace App\Utils;

use App\DTO\EventResponse;

class EventOutput
{
    /**
     * @param EventResponse $response
     * @return void
     */
    public static function send(EventResponse $response): void
    {
        header('Content-Type: application\json; charset=utf-8');
        http_response_code($response->getCode());
        echo $response->getMessage();
    }
}