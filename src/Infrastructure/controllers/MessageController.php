<?php

namespace App\Infrastructure\Controllers;

use App\Application\Services\Message;


class MessageController
{
    private $messageService;

    public function __construct(Message $messageService)
    {
        $this->messageService = $messageService;
    }

    public function index()
    {
        return $this->messageService->index();
    }
}