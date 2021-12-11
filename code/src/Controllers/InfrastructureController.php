<?php

declare(strict_types=1);

namespace Vshepelev\App\Controllers;

use Vshepelev\App\Response\Response;

class InfrastructureController
{
    public function getSessionInfo(): Response
    {
        return new Response([
            'session_save_handler' => ini_get('session.save_handler'),
            'session_save_path' => ini_get('session.save_path'),
            'session_status' => session_status()
        ]);
    }
}
