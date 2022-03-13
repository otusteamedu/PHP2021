<?php

namespace App\Infrastructure;

use App\Application\Contracts\EventRepositoryInterface;
use App\Domain\Event;
use Redis;

class EventRepository implements EventRepositoryInterface
{
    private const DATA_PREFIX = 'event:data:';
    private const STATUS_PREFIX = 'event:status:';

    private Redis $client;

    public function __construct(Redis $client)
    {
        $this->client = $client;
        $client->connect(getenv('LOCAL_HOST'), getenv('REDIS_PORT'));
    }

    public function findById(string $id): ?Event
    {
        $data = $this->client->get(self::DATA_PREFIX . $id);
        $status = $this->client->get(self::STATUS_PREFIX . $id);
        if ($data === false || $status === false) {
            return null;
        }

        return (new Event($id, $data))->setStatus($status);
    }

    public function create(Event $event): bool
    {
        $event->setStatus(Event::STATUS_IN_PROCESS);
        $setData = $this->client->set(
            self::DATA_PREFIX . $event->getId(),
            $event->getData()
        );
        $setStatus = $this->client->set(
            self::STATUS_PREFIX . $event->getId(),
            $event->getStatus()
        );

        return $setData && $setStatus;
    }

    public function update(Event $event): bool
    {
        return $this->client->set(
            self::STATUS_PREFIX . $event->getId(),
            $event->getStatus()
        );
    }
}
