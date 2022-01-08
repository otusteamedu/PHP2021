<?php

namespace App\Requests;

class Request
{
    protected $request;

    public function __construct($request)
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
        if (is_array($this->request)) {
            foreach ($this->request as $key => $value) {
                $prepared[$key] = $this->cleanString($value);
            }
        }
        return $prepared;
    }

    protected function cleanString($value): string
    {
        return htmlspecialchars(trim($value), ENT_QUOTES);
    }
}
