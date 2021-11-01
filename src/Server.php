<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 31.10.2021
 * Time: 16:51
 */

namespace app;

use app\components\SocketConnect;
use app\services\SocketService;
use Exception;

/**
 * Сервер приложения
 *
 * Class Server
 * @package src\environments
 */
class Server
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
    }

    /**
     * @throws Exception
     */
    private function execute()
    {
        $socketService = $this->_socketService;

        do {
            $connect = $socketService->accept();
            echo 'Клиент подключен' . PHP_EOL;

            $client = new SocketConnect($connect);
            $client->sendMessage('Добро пожаловать!!!');

            do {
                $message = $client->getMessage();

                if (empty($message) === true) {
                    continue;
                }

                if ($message === 'q!') {
                    $client->close();
                    echo 'Клиент отключен' . PHP_EOL;

                    break;
                }

                if ($message === 'exit') {
                    $client->close();
                    echo 'Отключение сервера' . PHP_EOL;

                    break 2;
                }

                $client->sendMessage("Сообщение $message доставлено");
                echo $message . PHP_EOL;
            } while (true);
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
        $socketService->listen();
    }

    /**
     * Закрывает сокет соединение
     */
    private function close()
    {
        $this
            ->_socketService
            ->close();
    }
}