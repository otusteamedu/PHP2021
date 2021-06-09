<?php declare(strict_types=1);

namespace App\Http\Request;

use App\Http\Interfaces\RequestInterface;

class Request implements RequestInterface
{
    private array $body;

    /**
     * @throws \JsonException
     */
    public function __construct()
    {
        $body = file_get_contents('php://input');

        $body = json_decode($body, true, 512, JSON_THROW_ON_ERROR);

        $this->body = $body;
    }

    public function getParam(string $name, mixed $default = null): mixed
    {
        return $this->body[$name] ?? $default;
    }

    public function getMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }
}
