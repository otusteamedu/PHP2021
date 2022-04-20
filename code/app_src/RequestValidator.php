<?php

namespace App;

class RequestValidator
{
    public static function checkRequestType(string $typeNeeded): bool
    {
        if ($_SERVER['REQUEST_METHOD'] == $typeNeeded) {
            return true;
        } else {
            return false;
        }
    }

    public static function checkRequestIsEmpty(array $request): bool
    {
        if (empty($request)) {
            return true;
        } else {
            return false;
        }
    }
}