<?php

declare(strict_types=1);

namespace App\Client;

class Client
{
	private const SOCKET_PATH = '/tmp/otus-php-sockets.sock';
	
	private $socket;
	    
    /** @var false|resource|\Socket */
    private $connection;
    
    private $simpleconnection;
    
	/**
     * Запускает клиент.
     */
    public function runClient()
    {
        try {            
            // Инициализируем соединение
            $this->initializeConnection();

        } catch (\Exception $e) {

            // Выводим сообщение об ошибке
            echo $e->getMessage().PHP_EOL;

        }
    }
    
    private function initializeConnection(){
		echo "Поднимаю соединение...".PHP_EOL;
        $this->connection = stream_socket_client('unix://'.self::SOCKET_PATH, $errno, $errst);
        if (!$this->connection) {
            throw new \Exception("Не удалось поднять соединение");
        }
        echo "Соединение поднято".PHP_EOL;
        echo "Введите сообщение".PHP_EOL;
		$message = '';
        while($message != 'выход'){
			$message = trim(fgets(STDIN));
			fwrite($this->connection, $message);
			echo trim(fread($this->connection, 255)).PHP_EOL;
		}
        fclose($this->connection);
        echo "Соединение закрыто".PHP_EOL;
	}
}
