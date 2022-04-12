<?php

namespace Ivanboriev\TrustedBrackets\Response;

use Ivanboriev\TrustedBrackets\Request\Request;

class Response
{
    /**
     * @param $message
     * @return void
     */
    public static function error($message)
    {
        header('HTTP/1.0 400 Bad Request');

        if (self::isJson()) {
            self::setJson();
            echo json_encode(['message' => $message]);
        } else {
            echo $message;
        }


    }

    /**
     * @param $message
     * @return void
     */
    public static function success($message)
    {
        header('HTTP/1.0 200 Ok');

        if (self::isJson()) {
            self::setJson();
            echo json_encode(['message' => $message]);
        } else {
            echo $message;
        }
    }

    /**
     * @return bool
     */
    private static function isJson(): bool
    {
        return $_SERVER['CONTENT_TYPE'] === 'application/json';
    }

    /**
     * @return void
     */
    private static function setJson()
    {
        header('Content-Type: application/json; charset=utf-8');
    }
}