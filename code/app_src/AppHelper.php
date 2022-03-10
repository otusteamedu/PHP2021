<?php

namespace App;

use App\Storage\ESStorage;
use App\Storage\RedisStorage;

class AppHelper
{
    private $request;

    public function __construct($request)
    {
      $this->request = $request;
    }

    public function getStorageInterface()
    {
      switch($this->request['storage']) {
        case 'ElasticSearch':
          return new ESStorage();

        case 'Redis':
          return new RedisStorage();

        default:
          throw new \Exception('No storage type selected');
      }
    }
}
