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

    public static function checkMainFields($request, $storageInterface)
    {
        foreach ($storageInterface->getMainFields() as $field) {
            if (!isset($request[$field]) || empty($request[$field])) {
                return false;
            }
        }

        return true;
    }
}
