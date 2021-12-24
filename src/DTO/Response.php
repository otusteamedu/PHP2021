<?php

namespace App\DTO;

class Response
{
    private string $message;
    private int $code;

    /**
     * @param string $message
     * @param int    $code
     */
    public function __construct(string $message = '', int $code = 200)
    {
        $this->code = $code;
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }
}
