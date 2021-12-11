<?php

declare(strict_types=1);

namespace Vshepelev\App\Response;

class Response
{
    private mixed $content;
    private HttpStatus $status;

    public function __construct(mixed $content, HttpStatus $status = HttpStatus::OK)
    {
        $this->content = $content;
        $this->status = $status;
    }

    public function send(): void
    {
        http_response_code($this->status->value);

        echo $this->content;
    }
}
