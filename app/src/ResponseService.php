<?php

namespace Src;

class ResponseService
{
    public function sendBadResponse(?string $content, array $headers = [])
    {
        $response = new Response($content, Response::HTTP_BAD_REQUEST, $headers);
        $response->send();
    }

    public function sendOkResponse(?string $content, array $headers = [])
    {
        $response = new Response($content, Response::HTTP_OK, $headers);
        $response->send();
    }
}
