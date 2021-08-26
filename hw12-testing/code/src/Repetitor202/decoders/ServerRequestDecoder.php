<?php

namespace Repetitor202\decoders;

use Psr\Http\Message\ServerRequestInterface;

class ServerRequestDecoder
{
    public function decodeParams(ServerRequestInterface $request): ?array
    {
        return json_decode($request->getBody()->getContents(), true);
    }
}