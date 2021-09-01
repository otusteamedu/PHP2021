<?php

namespace Chat;

use Exception;

class Config
{
    private const CONFIG_FILE = "/var/www/code/config.ini";

    private static array $config = [];

    public function __construct()
    {
        if (! file_exists(static::CONFIG_FILE)) {
            echo new Exception('Config file not found');
        }

        self::$config = parse_ini_file(static::CONFIG_FILE);
    }

    public function get($key): string
    {
        return self::$config[$key];
    }
}