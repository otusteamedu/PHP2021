<?php declare(strict_types=1);

namespace App\Http\Request;

use App\Http\Interfaces\RequestInterface;

class Request implements RequestInterface
{
    public function __construct(
        private array $parsedBody = [],
        private array $server = [],
    ){
    }

    public function getPost(string $name): ?string
    {
        return $this->parsedBody[$name] ?? null;
    }

    public function getMethod(): string
    {
        return $this->server['REQUEST_METHOD'];
    }
}
