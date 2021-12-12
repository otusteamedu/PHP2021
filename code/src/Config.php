<?php

namespace Vshepelev\App;

use InvalidArgumentException;

class Config
{
    private const CONFIGS_DIR = __DIR__ . '/../configs';

    /**
     * @throws InvalidArgumentException
     */
    public function get(string $configName): array
    {
        $configFileName = self::CONFIGS_DIR . "/{$configName}.php";

        if (!file_exists($configFileName)) {
            throw new InvalidArgumentException('Config not found');
        }

        $config = include $configFileName;

        if (!isset($config) || !is_array($config)) {
            throw new InvalidArgumentException('Config is empty');
        }

        return $config;
    }
}
