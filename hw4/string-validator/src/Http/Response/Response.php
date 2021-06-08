<?php declare(strict_types=1);

namespace App\Http\Response;

use App\Http\Interfaces\ResponseInterface;

class Response implements ResponseInterface
{
    public function __construct(
        protected int $status = 0,
        protected string $body = '',
        protected array $headers = []
    ) {
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function setBody(string $body): self
    {
        $this->body = $body;

        return $this;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function setHeaders(array $headers): self
    {
        $this->headers = $headers;

        return $this;
    }
}
