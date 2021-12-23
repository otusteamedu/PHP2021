<?php

namespace App\Infrastructure\Controllers;

use App\Application\Services\MessageAdmin;


class MessageAdminController
{
    private $messageAdminService;

    public function __construct(MessageAdmin $messageAdminService)
    {
        $this->messageAdminService = $messageAdminService;
    }

    public function index()
    {
        return $this->messageAdminService->index();
    }


}
