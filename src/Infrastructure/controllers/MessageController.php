<?php

namespace App\Infrastructure\Controllers;

use App\Application\Services\Message;
use Symfony\Component\HttpFoundation\Request;


class MessageController
{
    private $messageService;

    public function __construct(Message $messageService)
    {
        $this->messageService = $messageService;
    }

    public function index(Request $request)
    {
        return $this->messageService->index($request);
    }
}