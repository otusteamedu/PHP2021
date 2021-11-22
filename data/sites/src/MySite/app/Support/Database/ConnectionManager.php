<?php

declare(strict_types=1);

namespace MySite\app\Support\Database;


use MySite\app\Support\Contracts\DatabaseClient;
use MySite\app\Support\Contracts\DatabaseQuery;
use MySite\app\Support\Traits\SingletonTrait;

/**
 * Class ConnectionManager
 * @package MySite\app\Support\Database
 */
final class ConnectionManager
{
    use SingletonTrait;

    /**
     * @var DatabaseQuery[]
     */
    private static array $connections = [];

    /**
     * @param string|null $name
     * @return DatabaseQuery
     */
    public static function getInstance(?string $name): DatabaseQuery
    {
        if (!$name) {
            $name = getenv('DEFAULT_DB');
        }
        $name .= 'Client';

        if (!isset(self::$connections[$name])) {
            /** @var DatabaseClient $class */
            $class = 'MySite\app\Support\Database\Clients\\' . $name;
            self::$connections[$name] = $class::run();
        }

        return static::$connections[$name];
    }

}
