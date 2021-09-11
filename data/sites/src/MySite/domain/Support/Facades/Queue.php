<?php

declare(strict_types=1);

namespace MySite\domain\Support\Facades;

use Bunny\Channel;
use MySite\domain\Support\Queue\ConnectionManager;
use React\Promise\PromiseInterface;

/**
 * Class Queue
 * @package MySite\app\Support\Facades
 */
class Queue
{
    /**
     * @param $message
     * @param null $queue
     * @return bool
     */
    public static function pushRaw(
        $message,
        $queue = null
    ): bool {
        $queue ??= getenv('QUEUE_DEFAULT');

        $channel = self::getChannel();

        return (bool) $channel->publish(
            body: $message,
            routingKey: $queue,
            immediate: true
        );
    }

    /**
     * @return Channel
     */
    public static function getChannel(): Channel
    {
        $connection = ConnectionManager::getInstance();
        return $connection->channel();
    }
}
