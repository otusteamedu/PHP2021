<?php

namespace Vshepelev\App;

class Config
{
    private array $config;

    public function __construct(string $pathToConfig)
    {
        $this->config = parse_ini_file($pathToConfig);
    }

    /**
     * @param string $configName
     *
     * @return mixed|null
     */
    public function get(string $configName)
    {
        return $this->config[$configName] ?? null;
    }
}
