<?php


namespace App;


class Response
{
    public static function replyWithOk()
    {
        header("HTTP/1.1 200 OK");
        echo ('All fine here');
    }
    
    public static function replyWithError($errorMessage)
    {
        header("HTTP/1.1 404 Not Found");
        echo $errorMessage;
    }
}