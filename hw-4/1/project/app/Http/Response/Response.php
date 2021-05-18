<?php

namespace App\Http\Response;

class Response
{
    public function setStatus(int $status)
    {
        http_response_code($status);
    }
}