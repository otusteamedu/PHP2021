<?php

namespace App\Infrastructure;

use App\Application\Contracts\EventRepositoryInterface;
use App\Domain\Event;
use Redis;

class EventRepository implements EventRepositoryInterface
{
    private const PREFIX = 'event:';

    private Redis $client;

    public function __construct(Redis $client)
    {
        $this->client = $client;
        $client->connect(getenv('LOCAL_HOST'), getenv('REDIS_PORT'));
    }

    public function findById(string $id): ?Event
    {
        $item = $this->client->hGetAll(self::PREFIX . $id);
        if (is_null($item['data'] ?? null)
            || is_null($item['status'] ?? null)
        ) {
            return null;
        }

        return (new Event($item['data']))->setId($id)
                                         ->setStatus($item['status']);
    }

    public function create(Event $event): void
    {
        $event->setStatus(Event::STATUS_IN_PROCESS);
        $this->client->hMSet(self::PREFIX . $event->getId(), [
            'data'   => $event->getData(),
            'status' => $event->getStatus(),
        ]);
    }

    public function update(Event $event): void
    {
        $this->client->hSet(
            self::PREFIX . $event->getId(),
            'status',
            $event->getStatus()
        );
    }
}
