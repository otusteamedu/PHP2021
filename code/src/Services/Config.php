<?php

namespace Elastic\Services;

use Elastic\Exceptions\ConfigFileNotFoundException;

class Config
{
    private const CONFIG_FILE = __DIR__ . "/../config.ini";

    private static array $config = [];

    public function __construct()
    {
        if (! file_exists(static::CONFIG_FILE)) {
            throw new ConfigFileNotFoundException();
        }

        self::$config = parse_ini_file(static::CONFIG_FILE);
    }

    public function get($key): string
    {
        return self::$config[$key];
    }
}
