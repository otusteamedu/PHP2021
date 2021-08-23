<?php

declare(strict_types=1);

namespace MySite\app\Support\Facades;


use MySite\app\Support\Contracts\DatabaseQuery;
use MySite\app\Support\Database\ConnectionManager;

/**
 * Class Schema
 * @package MySite\app\Support\Facades
 */
class Schema
{

    public static function connection(?string $name = null): ?DatabaseQuery
    {
        return ConnectionManager::getInstance($name);
    }
}
