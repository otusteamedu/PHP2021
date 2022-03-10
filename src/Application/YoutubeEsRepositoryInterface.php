<?php

namespace App\Application;

use App\Domain\YoutubeChannel;

interface YoutubeEsRepositoryInterface
{
    public function search(array $statement): array;

    public function getAll(): array;

    public function get(string $channelId): ?YoutubeChannel;

    public function create(YoutubeChannel $channel): void;

    public function delete(string $channelId): void;

    public function populate(): void;

    public function clear(): void;
}
