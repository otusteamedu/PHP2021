<?php

namespace App;

use App\Infrastructure\RequestHandler;
use App\Helpers\AppHelper;

class Application
{
    private RequestHandler $handler;

    public function __construct()
    {
        $storage = AppHelper::getStorageClient();

        $this->handler = new RequestHandler($storage);
    }

    public function run(): void
    {
        $this->handler->execute();
    }
}
