<?php

namespace Src\Reader;

use Exception;

class TxtReader
{
    /**
     * @param string $file
     * @return array
     * @throws Exception
     */
    public function readToArray(string $file): array
    {
        if (!file_exists($file)) {
            throw new Exception('File not found');
        }

        $data = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if (false === $data) {
            throw new Exception('File read error');
        }

        return $data;
    }
}
