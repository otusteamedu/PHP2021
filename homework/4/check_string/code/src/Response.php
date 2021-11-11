<?php

namespace App;

class Response
{
    private $result;

    private $message;

    public function __construct(string $message = '', bool $result = false)
    {
        $this->setMessage($message);

        $this->setResult($result);
    }

    public static function success(string $message = ''): Response
    {
        return new Response($message, true);
    }

    public static function fail(string $message = ''): Response
    {
        return new Response($message, false);
    }

    public function setResult(bool $result): self
    {
        $this->result = $result;

        return $this;
    }

    public function getResult(): bool
    {
        return $this->result;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}