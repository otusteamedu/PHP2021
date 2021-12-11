<?php

declare(strict_types=1);

namespace Vshepelev\App\Response;

use JsonException;

class Response
{
    private mixed $content;
    private HttpStatus $status;

    public function __construct(mixed $content, HttpStatus $status = HttpStatus::OK)
    {
        $this->content = $content;
        $this->status = $status;
    }

    /**
     * @throws JsonException
     */
    public function send(): void
    {
        http_response_code($this->status->value);

        if (is_array($this->content)) {
            $this->content = json_encode($this->content, JSON_THROW_ON_ERROR);
        }

        echo $this->content;
    }
}
