<?php
declare(strict_types=1);
namespace App;

class Response
{
    public static function generateOkResponse(string $responseText) : void
    {
        header('HTTP/1.0 200 Ok');
        echo $responseText.PHP_EOL;
    }

    public static function generateBadRequestResponse(string $responseText) : void
    {
        header('HTTP/1.0 400 Bad Request');
        echo $responseText.PHP_EOL;
    }
}