<?php

namespace App\Http\Response;

class Response
{
    public function setStatus($status)
    {
        http_response_code($status);
    }
}