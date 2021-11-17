<?php

declare(strict_types=1);

namespace Sources;

use Sources\Controllers\ChatController;

final class App
{
    public function run(): void
    {
        $chat = new ChatController();
        $chat->start();
    }
}