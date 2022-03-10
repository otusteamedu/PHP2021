<?php

namespace App\Application;

use App\DTO\Response;

interface YoutubeChannelControllerInterface
{
    public const PATH = '/api/v1/youtube/channels';

    public function get(string $id): Response;

    public function getAll(): Response;

    public function create(): Response;

    public function delete(): Response;
}
