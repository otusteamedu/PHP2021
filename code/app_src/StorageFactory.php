<?php

namespace App;

use App\Storage\ESStorage;
use App\Storage\RedisStorage;

class StorageFactory
{
    public function getStorageInterface($request)
    {
        switch ($request['storage']) {

            case 'ElasticSearch':
                return new ESStorage();

            case 'Redis':
                return new RedisStorage();

            default:
                throw new \Exception('Хранилище не выбрано');
        }
    }
}
