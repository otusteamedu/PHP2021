<?php

declare(strict_types=1);

namespace App\Http;

class Request
{
    public function getPostParam($paramName): string
    {
        return $_POST[$paramName] ?? '';
    }
}