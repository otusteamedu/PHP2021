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
     * @return PromiseInterface|bool|int
     */
    public static function pushRaw(
        $message,
        $queue = null
    ): PromiseInterface|bool|int {
        $queue ??= getenv('QUEUE_DEFAULT');

        $channel = self::getChannel();

        return $channel->publish(
            body: $message,
            routingKey: $queue,
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
