<?php
declare(strict_types=1);
namespace App;

class RequestValidator
{
    public static function checkRequestType(string $typeNeeded) : bool
    {
        return $_SERVER['REQUEST_METHOD'] == $typeNeeded ? true : false;
    }

    public static function checkRequestIsEmpty(string $request) : bool
    {
        return empty($request) ? true : false;
    }

    public static function checkMainFields(string $request, array $storageInterface) : bool
    {
        foreach ($storageInterface->getMainFields() as $field) {
            if (!isset($request[$field]) || empty($request[$field])) {
                return false;
            }
        }

        return true;
    }
}