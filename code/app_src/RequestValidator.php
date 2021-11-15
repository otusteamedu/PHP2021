<?php

namespace App;

class RequestValidator
{
    public static function checkRequestType($typeNeeded)
    {
        return $_SERVER['REQUEST_METHOD'] == $typeNeeded ? true : false;
    }

    public static function checkRequestIsEmpty($request)
    {
        return empty($request) ? true : false;
    }
}