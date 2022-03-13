<?php

namespace App\Infrastructure;

use App\Application\Contracts\EventControllerInterface;
use App\Application\Contracts\EventServiceInterface;
use App\DTO\Request;
use App\DTO\Response;
use Exception;

/**
 * @OA\Info(title="Event API", version="0.1.0")
 */
class EventController implements EventControllerInterface
{
    private EventServiceInterface $service;

    public function __construct(EventServiceInterface $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *     path="/api/v1/event/{eventId}",
     *     operationId="getEventStatus",
     *     tags={"event"},
     *     summary="Get event status",
     *     description="Getting event status by id.",
     *     @OA\Parameter(
     *         name="eventId",
     *         in="path",
     *         description="ID of event that status needs to be fetched",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation (0 - in process, 1 - completed)",
     *         @OA\Schema(type="integer")
     *     )
     * )
     */
    public function get(string $id): Response
    {
        return $this->service->getStatus($id);
    }

    /**
     * @OA\Post(
     *     path="/api/v1/event",
     *     operationId="createEvent",
     *     tags={"event"},
     *     summary="Create event",
     *     description="Creating user event.",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Event",
     *         @OA\JsonContent(ref="#/components/schemas/Event")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="successful operation",
     *         @OA\Schema(type="string")
     *     )
     * )
     *
     * @throws Exception
     */
    public function create(): Response
    {
        $body = json_decode(file_get_contents('php://input'), true) ?? [];
        $event = new Request($body['data'] ?? '');

        return $this->service->create($event);
    }
}
