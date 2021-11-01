<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 31.10.2021
 * Time: 21:39
 */

namespace app\components;


use Exception;

/**
 * Подключенный клиент
 *
 * Class SocketConnect
 * @package app\components
 */
class SocketConnect
{
    /**
     * @var SocketHelper
     */
    private SocketHelper $_socketHelper;

    /**
     * SocketConnect constructor.
     * @param resource $connect
     */
    public function __construct($connect)
    {
        $this->_socketHelper = new SocketHelper($connect);
    }

    /**
     * Получает сообщение из сокета
     * @return string
     * @throws Exception
     */
    public function getMessage(): string
    {
        return $this
            ->_socketHelper
            ->read();
    }

    /**
     * Отправляет сообщение в сокет
     * @param string $message
     */
    public function sendMessage(string $message)
    {
        $this
            ->_socketHelper
            ->write($message);
    }

    /**
     * Закрывает сокет соединение
     */
    public function close()
    {
        $this
            ->_socketHelper
            ->close();
    }
}