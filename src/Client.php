<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 31.10.2021
 * Time: 16:51
 */

namespace app;

use app\services\SocketService;
use Exception;

/**
 * Клиент приложения
 *
 * Class Client
 * @package src\environments
 */
class Client
{
    /**
     * @var SocketService
     */
    private SocketService $_socketService;

    /**
     * Server constructor.
     */
    public function __construct()
    {
        $this->_socketService = new SocketService();
    }

    /**
     * Запуск сервера
     * @throws Exception
     */
    public function run()
    {
        try {
            $this->initialize();
            $this->execute();
        } finally {
            $this->close();
        }

        echo 'Клинет отключен' . PHP_EOL;
    }

    /**
     * @throws Exception
     */
    private function execute()
    {
        $socketService = $this->_socketService;

        do {
            $message = $socketService->getMessage();

            if (empty($message) === false) {
                echo $message . PHP_EOL;
            }

            $message = fgets(STDIN);

            if (empty($message) === false) {
                $socketService->sendMessage($message);
            }
        } while (true);
    }

    /**
     * Инициализирует сокет соединение
     * @throws Exception
     */
    private function initialize()
    {
        $socketService = $this->_socketService;

        $socketService->initialize();
        $socketService->connect();
    }

    /**
     * Закрывает сокет соединение
     */
    private function close()
    {
        $socketClient = $this->_socketService;

        $socketClient->close();
    }
}