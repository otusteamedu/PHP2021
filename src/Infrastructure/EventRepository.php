<?php

namespace App\Infrastructure;

use App\Application\Contracts\EventRepositoryInterface;
use App\Domain\Event;
use Redis;
use RedisException;

class EventRepository implements EventRepositoryInterface
{
    private const PREFIX = 'event:';

    private Redis $client;

    /**
     * @param Redis $client
     * @throws RedisException
     */
    public function __construct(Redis $client)
    {
        $this->client = $client;
        $client->connect(getenv('LOCAL_HOST'), getenv('REDIS_PORT'));
    }

    /**
     * @param string $id
     * @return Event|null
     * @throws RedisException
     */
    public function findById(string $id): ?Event
    {
        $item = $this->client->hGetAll(self::PREFIX.$id);
        if ($item['data'] || $item['status']) {
            return (new Event($item['data']))
                ->setId($id)
                ->setStatus($item['status']);
        }
        return null;
    }

    /**
     * @param Event $event
     * @return void
     * @throws RedisException
     */
    public function create(Event $event): void
    {
        $event->setStatus(Event::STATUS_IN_PROCESS);
        $this->client->hMSet(self::PREFIX . $event->getId(),[
           'data'   => $event->getData(),
           'status' => $event->getStatus()
        ]);
    }

    /**
     * @param Event $event
     * @return void
     * @throws RedisException
     */
    public function update(Event $event): void
    {
        $this->client->hSet(
            self::PREFIX.$event->getId(),
            'status',
            $event->getStatus()
        );
    }
}