<?php

declare(strict_types=1);

namespace Sources\Services;

class HttpResponse
{
    private int $code;
    private string $message;

    public function __construct($code, $message)
    {
        $this->code = $code;
        $this->message = $message;
    }

    public function send(): void
    {
        http_response_code($this->code);
        echo $this->message;
    }
}