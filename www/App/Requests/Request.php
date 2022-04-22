<?php

declare(strict_types=1);

namespace App\Requests;

class Request
{
    protected array $request;

    public function __construct(array $request)
    {
        $this->request = $request;
    }

    public function all(): array
    {
        return $this->prepareRequest();
    }

    protected function prepareRequest(): array
    {
        $prepared = [];

        foreach ($this->request as $key => $value) {
            $prepared[$key] = $this->cleanString($value);
        }

        return $prepared;
    }

    protected function cleanString($value): string
    {
        return htmlspecialchars(trim($value), ENT_QUOTES);
    }
}
