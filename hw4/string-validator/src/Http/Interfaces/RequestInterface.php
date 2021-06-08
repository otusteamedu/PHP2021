<?php declare(strict_types=1);

namespace App\Http\Interfaces;

interface RequestInterface
{
    public function getPost(string $name): ?string;

    public function getMethod(): string;
}
