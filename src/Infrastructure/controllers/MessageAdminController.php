<?php

namespace App\Infrastructure\Controllers;

use App\Application\Services\MessageAdmin;
use Symfony\Component\HttpFoundation\Request;


class MessageAdminController
{
    private $messageAdminService;

    public function __construct(MessageAdmin $messageAdminService)
    {
        $this->messageAdminService = $messageAdminService;
    }

    public function index(Request $request)
    {
        return $this->messageAdminService->index($request);
    }


}
