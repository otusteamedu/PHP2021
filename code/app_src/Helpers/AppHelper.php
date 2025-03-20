<?php

namespace App\Helpers;

use App\Infrastructure\Consumer;
use App\Infrastructure\Publisher;
use App\Application\Interfaces\StorageInterface;
use App\Domain\RedisStorage;

class AppHelper
{
    public static function createPublisher($adapter): Publisher
    {
        return new Publisher($adapter->connection);
    }

    public static function createConsumer($adapter, StorageInterface $storageClient): Consumer
    {
        return new Consumer($adapter->connection, $storageClient);
    }

    public static function getStorageClient(): StorageInterface
    {
        return new RedisStorage();
    }
}
