<?php 

namespace App;

class Response
{
    public static function generateResponse($responseText)
    {
        switch($responseText) {

            case 'Everything is fine':
                header('HTTP/1.0 200 Ok');

                break;

            default:
                header('HTTP/1.0 400 Bad Request');

                break;
        }
        echo $responseText.PHP_EOL;
    }
}
