<?php

namespace App;

class Response
{
    public static function generateBadRequestResponse($responseText)
    {
        header('HTTP/1.0 400 Bad Request');
        
        echo $responseText;
    }
}
