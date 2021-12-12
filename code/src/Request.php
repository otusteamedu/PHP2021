<?php

declare(strict_types=1);

namespace Vshepelev\App;

use JetBrains\PhpStorm\Pure;

class Request
{
    private array $post;
    private array $server;

    private function __construct(array $post, array $server)
    {
        $this->post = $post;
        $this->server = $server;
    }

    #[Pure]
    public static function capture(): self
    {
        return new self($_POST, $_SERVER);
    }

    public function method(): string
    {
        return $this->server['REQUEST_METHOD'];
    }

    public function uri(): string
    {
        return $this->server['REQUEST_URI'];
    }

    public function input(string $key): ?string
    {
        return $this->post[$key] ?? null;
    }
}
