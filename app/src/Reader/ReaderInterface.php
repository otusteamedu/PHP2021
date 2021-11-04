<?php

namespace App\Reader;

interface ReaderInterface
{
    /**
     * @param string $path путь до файла с конфигом
     * @return array конфиг
     */
    function read(string $path): array;
}
