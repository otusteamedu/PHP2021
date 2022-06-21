<?php

namespace Src;

class Response
{
    public static function success()
    {
        header('HTTP/1.0 200 Ok');
        echo '200 Ok';
    }

    public static function fail()
    {
        header('HTTP/1.0 400 Bad Request');
        echo '400 Bad Request';
    }
}