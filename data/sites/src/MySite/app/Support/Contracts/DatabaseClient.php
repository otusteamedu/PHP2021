<?php

namespace MySite\app\Support\Contracts;


/**
 * Interface DatabaseClient
 * @package MySite\app\Support\Contracts
 */
interface DatabaseClient
{

    /**
     * @return DatabaseQuery
     */
    public static function run(): DatabaseQuery;
}
