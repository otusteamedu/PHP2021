<?php

declare(strict_types=1);

namespace MySite\domain\Support\Queue\Clients;

use Bunny\Client;
use Exception;

/**
 * Class RabbitClient
 * @package MySite\app\Support\Queue\Clients
 */
final class RabbitClient
{
    /**
     * @return Client
     * @throws Exception
     */
    public static function run(): Client
    {
        $connection = [
            'host' => getenv('QUEUE_HOST'),
            'user' => getenv('QUEUE_USER'),
            'password' => getenv('QUEUE_PASSWORD'),
        ];

        $bunny = new Client($connection);
        return $bunny->connect();
    }
}
