<?php

namespace App;

use App\Chat\ChatModeHandlerFactory;

class App
{
    public function run(string $mode)
    {
        $handler = ChatModeHandlerFactory::getInstance($mode);
        $handler->run();
    }
}
