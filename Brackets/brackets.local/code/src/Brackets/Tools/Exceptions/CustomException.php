<?php


declare(strict_types=1);


namespace Brackets\Tools\Exceptions;


class CustomException
{

    /**
     * throw some http exception
     *
     * @param int $code
     * @param string $text
     */
    public static function throwHTTPException(int $code = 400, string $text = "BAD REQUEST")
    {
        header("HTTP/1.1 400: $text");
        exit();
    }

}