<?php

namespace App\Reader;

class IniReader implements ReaderInterface
{
    /**
     * @param string $path путь до файла с конфигом
     * @return array конфиг
     * @throws \Exception
     */
    public function read(string $path): array
    {
        $config = parse_ini_file($path);
        if ($config === false) {
            throw new \Exception('Не получилось прочитать конфиг');
        }

        return $config;
    }
}
