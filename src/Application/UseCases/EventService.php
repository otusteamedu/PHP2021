<?php

namespace App\Application\UseCases;

use App\Application\Contracts\ConsumerInterface;
use App\Application\Contracts\EventRepositoryInterface;
use App\Application\Contracts\EventServiceInterface;
use App\Application\Contracts\PublisherInterface;
use App\Domain\Event;
use App\DTO\Request;
use App\DTO\Response;
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

    public function getStatus(string $id): Response
    {
        $event = $this->repository->findById($id);
        if (is_null($event)) {
            return new Response('event is not found', 404);
        }

        return new Response($event->getStatus());
    }

    /**
     * @throws Exception
     */
    public function create(Request $req): Response
    {
        $id = uniqid();
        $body = $req->getBody();
        if (empty($body)) {
            throw new Exception('event is not valid');
        }
        $event = new Event($id, $body);
        $this->repository->create($event);

        return $this->publisher->execute(
            ConsumerInterface::QUEUE_NAME,
            new Request($id)
        );
    }

    /**
     * @throws Exception
     */
    public function execute(string $id): void
    {
        $event = $this->repository->findById($id);
        if (is_null($event)) {
            throw new Exception('event is not found');
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
