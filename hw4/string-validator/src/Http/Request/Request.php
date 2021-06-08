<?php declare(strict_types=1);

namespace App\Http\Request;

use App\Http\Interfaces\RequestInterface;

class Request implements RequestInterface
{
    public function getPost(string $name): ?string
    {
        return $_POST[$name] ?? null;
    }

    public function getMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }
}
