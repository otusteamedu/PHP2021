<?php

namespace App\Http;

class Response
{
    const STATUS_OK = 200;
    const STATUS_BAD_REQUEST = 400;
    const STATUS_UNSUPPORTED_TYPE = 415;

    static public function setResponse(int $code, ?string $message = null) : void
    {
        if (!empty($message)) {
            header($_SERVER["SERVER_PROTOCOL"] . ' ' . $code . ' ' . $message);
        } else {
            http_response_code($code);
        }
    }
}
