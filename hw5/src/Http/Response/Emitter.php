<?php


namespace App\Http\Response;


use App\Http\Interfaces\EmitterInterface;
use App\Http\Interfaces\ResponseInterface;

class Emitter implements EmitterInterface
{
    public function emit(ResponseInterface $response)
    {
        foreach ($response->getHeaders() as $name => $value) {
            \header("$name: $value");
        }

        \http_response_code($response->getStatus());

        echo $response->getBody();
    }
}
