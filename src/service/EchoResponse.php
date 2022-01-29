<?php

namespace Src\service;

class EchoResponse implements ResponseInterface
{
    public function OkResponse($message)
    {
        http_response_code(200);
        echo $message;
    }

    public function BadResponse($message)
    {
        http_response_code(400);
        echo $message;
    }

    public function NotFoundResponse(){
        http_response_code(404);
        echo '404 Not Found';
    }

}