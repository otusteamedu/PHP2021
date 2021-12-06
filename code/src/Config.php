<?php

namespace Vshepelev\App;

use Vshepelev\App\Exceptions\ConfigNotFoundException;

class Config
{
    private array $config;

    /**
     * @throws ConfigNotFoundException
     */
    public function __construct(string $pathToConfig)
    {
        if (!$config = parse_ini_file($pathToConfig)) {
            throw new ConfigNotFoundException('Не удалось найти конфигурационный файл ' . $pathToConfig);
        }

        $this->config = $config;
    }

    public function get(string $configName): ?string
    {
        return $this->config[$configName] ?? null;
    }
}
