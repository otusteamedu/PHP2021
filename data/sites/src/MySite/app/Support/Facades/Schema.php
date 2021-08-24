<?php


namespace MySite\app\Support\Facades;


use Doctrine\ORM\EntityManager;
use MySite\app\Support\Contracts\DatabaseQuery;
use MySite\app\Support\Database\ConnectionManager;

class Schema
{

    public static function connection(?string $name = null): DatabaseQuery|EntityManager|null
    {
        return ConnectionManager::getInstance($name);
    }
}
