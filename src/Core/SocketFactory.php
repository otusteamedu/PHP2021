<?php

namespace App\Core;

use App\Core\Client\ClientSocket;
use App\Core\Server\ServerSocket;
use InvalidArgumentException;

abstract class SocketFactory
{
    public const
        SOCKET_SERVER = 'server',
        SOCKET_CLIENT = 'client';

    /**
     * @param string $type
     * @return BaseSocket
     */
    public static function create(string $type): BaseSocket
    {
        if ($type === self::SOCKET_SERVER) {
            return new ServerSocket();
        }

        if ($type === self::SOCKET_CLIENT) {
            return new ClientSocket();
        }

        throw new InvalidArgumentException("Class {$type} not exists in socket factory");
    }
}
