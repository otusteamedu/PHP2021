<?php

namespace App\Application\UseCases;

use App\Application\Contracts\ConsumerInterface;
use App\Application\Contracts\EventRepositoryInterface;
use App\Application\Contracts\EventServiceInterface;
use App\Application\Contracts\PublisherInterface;
use App\Domain\Event;
use App\DTO\EventRequest;
use App\DTO\EventResponse;
use Exception;

class EventService implements EventServiceInterface
{
    private EventRepositoryInterface $repository;
    private PublisherInterface $publisher;

    /**
     * @param EventRepositoryInterface $repository
     * @param PublisherInterface $publisher
     */
    public function __construct(
        EventRepositoryInterface $repository,
        PublisherInterface $publisher
    )
    {
        $this->repository = $repository;
        $this->publisher = $publisher;
    }

    /**
     * @param string $id
     * @return EventResponse
     * @throws Exception
     */
    public function getStatus(string $id): EventResponse
    {
        $event = $this->repository->findById($id);
        if (is_null($event)) throw new Exception('not found event');
        return new EventResponse($event->getStatus());
    }

    /**
     * @param string $id
     * @return void
     * @throws Exception
     */
    public function execute(string $id): void
    {
        $event = $this->repository->findById($id);
        if (is_null($event)) throw new Exception('not found event');
        $this->process($event);
        $this->repository->update($event);
    }

    /**
     * @param Event $event
     * @return void
     */
    private function process(Event $event): void
    {
        sleep(15);
        $event->setStatus(Event::STATUS_COMPLETED);
    }

    /**
     * @param EventRequest $response
     * @return EventResponse
     * @throws Exception
     */
    public function create(EventRequest $response): EventResponse
    {
        $event = new Event($response->getBody());
        $this->repository->create($event);

        return $this->publisher->execute(
            ConsumerInterface::QUEUE_NAME,
            new EventRequest($event->getId())
        );
    }

}