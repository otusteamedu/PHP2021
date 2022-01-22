<?php

namespace App;

use App\Core\SocketFactory;
use App\Exceptions\SocketException;

class App
{
    private const CONFIG_FILE_NAME = '../config/config.ini';

    /**
     * @param string $type
     * @return void
     */
    public function run(string $type): void
    {
        try {
            SocketFactory::create($type)->run($this->getConfig());
        } catch (SocketException $e) {
            echo $e->getMessage() . PHP_EOL;
        }
    }

    /**
     * @return array
     */
    private function getConfig(): array
    {
        $config = parse_ini_file(__DIR__ . '/' .self::CONFIG_FILE_NAME);

        if (!is_array($config)) {
            throw new \InvalidArgumentException(
                'Не удалось загрузить файл конфигурации ' . self::CONFIG_FILE_NAME
            );
        }

        return $config;
    }
}
