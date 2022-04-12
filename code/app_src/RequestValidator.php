<?php

namespace App;

class RequestValidator
{
    public static function checkRequestType($typeNeeded)
    {
        if($_SERVER['REQUEST_METHOD'] == $typeNeeded) {
            return true;
        } else {
            return false;
        }
    }

    public static function checkRequestIsEmpty($request)
    {
        if(empty($request)) {
            return true;
        } else {
            return false;
        }
    }
}