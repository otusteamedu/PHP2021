<?php declare(strict_types=1);

namespace App\Http\Interfaces;

interface HandlerInterface
{
    public function handle(RequestInterface $request): ResponseInterface;
}
