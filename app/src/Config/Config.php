<?php

namespace App\Config;

use App\Reader\ReaderInterface;

class Config
{
    private string $path;
    private array $config;

    /**
     * Config constructor.
     *
     * @param string $path путь до файла с конфигом
     * @param ReaderInterface $reader
     * @throws \Exception
     */
    public function __construct(string $path, ReaderInterface $reader)
    {
        if (empty($path)) {
            throw new \Exception('Передан пустой путь до файла с конфигом');
        }

        if (!file_exists($path)) {
            throw new \Exception('Конфиг не найден');
        }

        if (!is_readable($path)) {
            throw new \Exception('Конфиг не доступен для чтения');
        }
        $this->path = $path;

        $this->config = $reader->read($path);
    }

    /**
     * @param string $name название настройки
     * @return string значение настройки
     * @throws \Exception
     */
    public function getValue($name): string
    {
        if (!isset($this->config[$name])) {
            throw new \Exception('Конфиг не доступен для чтения');
        }

        return $this->config[$name];
    }
}
