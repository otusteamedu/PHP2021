<?php

namespace App\Application\UseCases;

use App\Application\Contracts\ConsumerInterface;
use App\Application\Contracts\EventRepositoryInterface;
use App\Application\Contracts\EventServiceInterface;
use App\Application\Contracts\PublisherInterface;
use App\Domain\Event;
use App\DTO\EventRequest;
use App\DTO\EventResponse;
use App\Exception\EventBadRequestException;
use App\Exception\EventNotFoundException;
use Exception;

class EventService implements EventServiceInterface
{
    private EventRepositoryInterface $repository;
    private PublisherInterface $publisher;

    public function __construct(
        EventRepositoryInterface $repository,
        PublisherInterface $publisher
    ) {
        $this->repository = $repository;
        $this->publisher = $publisher;
    }

    /**
     * @throws Exception
     */
    public function getStatus(string $id): EventResponse
    {
        $event = $this->repository->findById($id);
        if (is_null($event)) {
            throw new EventNotFoundException('event is not found');
        }

        return new EventResponse($event->getStatus());
    }

    /**
     * @throws Exception
     */
    public function create(EventRequest $req): EventResponse
    {
        $event = new Event($req->getBody());
        $this->repository->create($event);

        return $this->publisher->execute(
            ConsumerInterface::QUEUE_NAME,
            new EventRequest($event->getId())
        );
    }

    /**
     * @throws Exception
     */
    public function execute(string $id): void
    {
        $event = $this->repository->findById($id);
        if (is_null($event)) {
            throw new EventNotFoundException('event is not found');
        }
        $this->process($event);
        $this->repository->update($event);
    }

    private function process(Event $event): void
    {
        sleep(15);
        $event->setStatus(Event::STATUS_COMPLETED);
    }
}
