<?php

namespace App;

class RequestValidator
{
    public static function checkRequestType(string $typeNeeded): bool
    {
        return $_SERVER['REQUEST_METHOD'] == $typeNeeded;
    }
}