<?php

namespace App\Config;

class Yaml
{
    /**
     * @throws ConfigException
     */
    public static function parse(string $path): array
    {
        $config = \yaml_parse_file($path);

        if ($config === false) {
            throw new ConfigException("Cannot parse yaml file. Path: $path");
        }

        return $config;
    }
}
