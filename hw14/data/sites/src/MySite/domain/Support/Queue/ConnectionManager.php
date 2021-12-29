<?php

declare(strict_types=1);

namespace MySite\domain\Support\Queue;


use Bunny\Client;
use MySite\domain\Support\Queue\Contracts\QueueClient;
use MySite\domain\Support\Traits\SingletonTrait;

/**
 * Class ConnectionManager
 * @package MySite\app\Support\Database
 */
final class ConnectionManager
{
    use SingletonTrait;

    /**
     * @var Client
     */
    private static Client $connection;

    /**
     * @param string|null $name
     * @return Client
     */
    public static function getInstance(?string $name = null): Client
    {
        if (!$name) {
            $name = getenv('QUEUE_TYPE');
        }
        $name .= 'Client';

        if (!isset(self::$connection)) {
            /** @var QueueClient $class */
            $class = 'MySite\domain\Support\Queue\Clients\\' . $name;
            self::$connection = $class::run();
        }

        return ConnectionManager::$connection;
    }

}
