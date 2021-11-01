<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 31.10.2021
 * Time: 20:47
 */

namespace app\components;


use Exception;

/**
 * Отдельное соединение клиента с сервером
 *
 * Class SocketConnect
 * @package app\components
 */
class SocketHelper
{
    /**
     * @var resource
     */
    private $_socket;

    /**
     * SocketConnect constructor.
     * @param resource $socket
     */
    public function __construct($socket)
    {
        $this->_socket = $socket;
    }

    /**
     * Отправлет сообщение в сокет
     * @param string $message
     */
    public function write(string $message)
    {
        $socket = $this->_socket;

        socket_write($socket, $message, strlen($message));
    }

    /**
     * Получает сообщение из сокета
     * @return string
     * @throws Exception
     */
    public function read(): string
    {
        $socket = $this->_socket;

        $message = socket_read($socket, 1024);
        if ($message === false) {
            throw new Exception('Не удалось получить сообщение');
        }

        return trim($message);
    }

    /**
     * Закрывает соединение
     */
    public function close()
    {
        $socket = $this->_socket;

        if ($socket !== null) {
            socket_close($socket);
        }
    }
}