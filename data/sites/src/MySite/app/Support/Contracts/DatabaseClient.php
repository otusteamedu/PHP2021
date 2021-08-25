<?php


namespace MySite\app\Support\Contracts;


use Doctrine\ORM\EntityManager;

/**
 * Interface DatabaseClient
 * @package MySite\app\Support\Contracts
 */
interface DatabaseClient
{

    /**
     * @return EntityManager
     */
    public static function run(): EntityManager;
}
