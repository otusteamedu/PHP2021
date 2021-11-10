<?php

namespace App\Services;

use App\Exceptions\FileNotFountException;

class Config
{
    private const PATH_TO_CONFIG = __DIR__ . '/../config.ini';

    private static array $config = [];

    private function __construct()
    {

    }

    public static function get($key): string
    {
        if (!self::$config) {
            $config = new static();
            $config->readConfig();
        }

        return self::$config[$key] ?? '';
    }

    private function readConfig()
    {
        if (! file_exists(self::PATH_TO_CONFIG)) {
            throw new FileNotFountException(self::PATH_TO_CONFIG);
        }

        self::$config = parse_ini_file(self::PATH_TO_CONFIG);;
    }
}
