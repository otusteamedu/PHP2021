<?php

namespace Repetitor202\controllers;

use Psr\Http\Message\ServerRequestInterface;

class TestController
{
    public function phpInfo(ServerRequestInterface $request): void
    {
        phpinfo();
    }

    private function getArgs(ServerRequestInterface $request): array
    {
        $bodyRaw = json_decode($request->getBody()->getContents(), true); // raw
        $bodyFormData = $request->getParsedBody(); // form-data

        return [
            'queryParams' => $request->getQueryParams(),
            'bodyRaw' => $bodyRaw,
            'bodyFormData' => $bodyFormData,
        ];
    }

    public function testGet(ServerRequestInterface $request): array
    {
        return $this->getArgs($request);
    }

    public function testPost(ServerRequestInterface $request): array
    {
        return $this->getArgs($request);
    }

    public function testPatch(ServerRequestInterface $request): array
    {
        return $this->getArgs($request);
    }

    public function testDelete(ServerRequestInterface $request): array
    {
        return $this->getArgs($request);
    }
}