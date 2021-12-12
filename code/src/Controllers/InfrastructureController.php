<?php

declare(strict_types=1);

namespace Vshepelev\App\Controllers;

use Memcached;
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

    public function setToCache(): Response
    {
        $memcached = new Memcached();
        $memcached->addServer('mcrouter', 11211);
        $status = $memcached->add('otus-key', 'otus-value');

        return new Response($status ? 'Value is set' : 'Value is not set');
    }

    public function getFromCache(): Response
    {
        $memcached = new Memcached();
        $memcached->addServer('mcrouter', 11211);
        $value = $memcached->get('otus-key');

        return new Response($value);
    }
}
