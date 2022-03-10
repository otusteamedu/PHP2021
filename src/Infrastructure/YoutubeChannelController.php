<?php

namespace App\Infrastructure;

use App\Application\YoutubeChannelControllerInterface;
use App\Application\YoutubeEsRepositoryInterface;
use App\DTO\Response;
use Exception;

class YoutubeChannelController implements YoutubeChannelControllerInterface
{
    private YoutubeEsRepositoryInterface $repository;

    public function __construct(YoutubeEsRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @throws Exception
     */
    public function getAll(): Response
    {
        $channels = $this->repository->getAll();

        return new Response(
            json_encode(
                array_map(fn($channel) => $channel->toArray(), $channels),
                JSON_PRETTY_PRINT
            ), 200
        );
    }

    /**
     * @throws Exception
     */
    public function get(string $id): Response
    {
        $channel = $this->repository->get($id);
        if ($channel !== null) {
            $channel = $channel->toArray();
        }

        return new Response(
            json_encode($channel, JSON_PRETTY_PRINT), 200
        );
    }

    /**
     * @throws Exception
     */
    public function create(): Response
    {
        $this->repository->populate();

        return new Response('', 201);
    }

    /**
     * @throws Exception
     */
    public function delete(): Response
    {
        $this->repository->clear();

        return new Response('', 204);
    }
}
