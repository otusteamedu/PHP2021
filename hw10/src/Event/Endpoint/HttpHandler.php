<?php declare(strict_types=1);

namespace App\Event\Endpoint;

use App\Event\EventRepositoryInterface;
use App\Http\Response\CreatedResponse;
use App\Http\Response\DeletedResponse;
use App\Http\Response\InvalidJsonResponse;
use App\Http\Response\NotFoundResponse;
use App\Http\Response\OkResponse;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class HttpHandler
{
    public function __construct(
        private EventRepositoryInterface $eventRepository
    ) {
    }

    public function create(ServerRequestInterface $request): ResponseInterface
    {
        $body = $request->getParsedBody();

        try {
            $this->eventRepository->add(
                $body['conditions'] ?? null,
                $body['event'] ?? null,
                $body['priority'] ?? null
            );
        } catch (\TypeError) {
            return new InvalidJsonResponse();
        }

        return new CreatedResponse();
    }

    public function findAllByConditions(ServerRequestInterface $request): ResponseInterface
    {
        $body = $request->getParsedBody();

        try {
            $events = $this->eventRepository->findAllByConditions($body['conditions'] ?? null);
        } catch (\InvalidArgumentException) {
            return new InvalidJsonResponse();
        }

        return new JsonResponse($events, 200);
    }

    public function findOneByConditionsWithHighestScore(ServerRequestInterface $request): ResponseInterface
    {
        $body = $request->getParsedBody();

        try {
            $event = $this->eventRepository->findOneWithHighestPriorityByConditions($body['conditions'] ?? null);
        } catch (\InvalidArgumentException) {
            return new InvalidJsonResponse();
        }

        if ($event === null) {
            return new NotFoundResponse();
        }

        return new JsonResponse($event, 200);
    }

    public function deleteAllEventsByConditions(ServerRequestInterface $request): ResponseInterface
    {
        $body = $request->getParsedBody();

        try {
            $deleted = $this->eventRepository->deleteAllEventsByConditions($body['conditions'] ?? null);
        } catch (\InvalidArgumentException) {
            return new InvalidJsonResponse();
        }

        return new DeletedResponse($deleted);
    }

    public function deleteOneEvent(ServerRequestInterface $request): ResponseInterface
    {
        $body = $request->getParsedBody();

        try {
            $deleted = $this->eventRepository->deleteOneEvent(
                $body['conditions'] ?? null,
                $body['event'] ?? null
            );
        } catch (\InvalidArgumentException) {
            return new InvalidJsonResponse();
        }

        return new DeletedResponse($deleted);
    }

    public function flush(ServerRequestInterface $request): ResponseInterface
    {
        try {
            $this->eventRepository->flush();
        } catch (\InvalidArgumentException) {
            return new InvalidJsonResponse();
        }

        return new OkResponse();
    }
}
