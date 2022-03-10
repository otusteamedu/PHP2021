<?php

namespace App;

class RequestValidator
{
    public static function validate($request)
    {
      if (!self::checkRequestType('POST')) {
          throw new \Exception('Wrong request method');
      }
      if (self::checkRequestIsEmpty($request)) {
          throw new \Exception('Empty request');
      }

      return $request;
    }

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
