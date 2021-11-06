<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 31.10.2021
 * Time: 20:30
 */

namespace app\services;

use app\components\SocketHelper;
use Exception;

/**
 * Сервис управления сокет соединением
 *
 * Class SocketClient
 * @package app\components
 */
class SocketService
{
    /**
     * @var null|resource
     */
    private $socket;
    /**
     * @var SocketHelper|null
     */
    private ?SocketHelper $socketHelper;
    /**
     * @var string
     */
    private $socketAddress;

    /**
     * SocketService constructor.
     * @throws Exception
     */
    public function __construct()
    {
        $config = parse_ini_file('./config.ini');

        if (array_key_exists('socket_address', $config) === false) {
            throw new Exception('Адрес сокета не задан');
        }

        $this->socketAddress = $config['socket_address'];
    }

    /**
     * Создает сокет соединение
     */
    public function initialize()
    {
        $socket = socket_create(AF_UNIX, SOCK_STREAM, 0);

        $this->socket = $socket;
        $this->socketHelper = new SocketHelper($socket);
    }

    /**
     * Прослушивает сокет
     * @throws Exception
     */
    public function listen()
    {
        $socket = $this->socket;

        if (socket_bind($socket, $this->socketAddress) === false) {
            throw new Exception("Не удалось привязать имя к сокету");
        }

        if (socket_listen($socket) === false) {
            throw new Exception("Не удалось начать прослушивать соединение");
        }
    }

    /**
     * Присоединяется к серверу
     * @throws Exception
     */
    public function connect()
    {
        $socket = $this->socket;

        if (socket_connect($socket, $this->socketAddress) === false) {
            throw new Exception("Не удалось присоединиться к серверу");
        }
    }

    /**
     * Закрывает сокет соединение
     */
    public function close()
    {
        $this
            ->socketHelper
            ->close();

        if (file_exists($this->socketAddress) === true) {
            unlink($this->socketAddress);
        }
    }

    /**
     * Добавляет клиента
     * @return resource
     * @throws Exception
     */
    public function accept()
    {
        $socket = $this->socket;
        $connect = socket_accept($socket);

        if ($connect === false) {
            throw new Exception("Не удалось подключить клиента");
        }

        return $connect;
    }

    /**
     * Получает сообщение из сокета
     * @return string
     * @throws Exception
     */
    public function getMessage(): string
    {
        return $this
            ->socketHelper
            ->read();
    }

    /**
     * Отправляет сообщение в сокет
     * @param string $message
     */
    public function sendMessage(string $message)
    {
        $this
            ->socketHelper
            ->write($message);
    }
}