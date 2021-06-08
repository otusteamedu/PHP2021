<?php declare(strict_types=1);

namespace App\Http\Interfaces;

interface ResponseInterface
{
    public function setStatus(int $status): self;

    public function getStatus(): int;

    public function getBody(): string;

    public function setBody(string $body): self;

    public function getHeaders(): array;

    public function setHeaders(array $headers): self;
}
