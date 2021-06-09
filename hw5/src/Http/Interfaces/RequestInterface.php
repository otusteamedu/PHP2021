<?php declare(strict_types=1);

namespace App\Http\Interfaces;

interface RequestInterface
{
    public function getParam(string $name, mixed $default = null): mixed;

    public function getMethod(): string;
}
