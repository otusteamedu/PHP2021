<?php

declare(strict_types=1);

namespace App\Apps;

use App\Config\Configuration;
use App\Socket\Exceptions\SocketCreateException;
use App\Socket\ServerSocket;
use App\Socket\Socket;
use UnexpectedValueException;

class AppFactory
{
    /**
     * @throws SocketCreateException
     */
    public static function create(string $appType, Configuration $config): AppInterface
    {
        switch ($appType) {
            case AppTypes::SERVER:
                return new ServerApp(self::buildServerSocket($config));

            case AppTypes::CLIENT:
                return new ClientApp(self::buildSocket($config));

            default:
                throw new UnexpectedValueException('Неизвестный тип приложения');
        }
    }

    /**
     * @throws SocketCreateException
     */
    private static function buildServerSocket(Configuration $config): ServerSocket
    {
        return ServerSocket::create(
            $config->getParam('address'),
            intval($config->getParam('port')),
            intval($config->getParam('maxConnection'))
        );
    }

    /**
     * @throws SocketCreateException
     */
    private static function buildSocket(Configuration $config): Socket
    {
        return Socket::createFromAddress(
            $config->getParam('address'),
            intval($config->getParam('port')));
    }
}