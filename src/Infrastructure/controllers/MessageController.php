<?php

namespace App\Infrastructure\Controllers;


use App\Application\DTO\MessageDTO;
use App\Application\Services\Message;
use App\Domain\Models\Image;


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