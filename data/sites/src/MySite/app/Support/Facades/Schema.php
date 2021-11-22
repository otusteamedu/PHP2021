<?php


namespace MySite\app\Support\Facades;


use MySite\app\Support\Contracts\DatabaseQuery;
use MySite\app\Support\Database\ConnectionManager;

class Schema
{

    public static function connection(?string $name = null): ?DatabaseQuery
    {
        return ConnectionManager::getInstance($name);
    }
}
