<?php


namespace AppCore\Configuration;
use Symfony\Component\Yaml\Yaml;

class ConfigParser implements ConfigParserInterface
{
    public function getConfigData(string $file = 'config.yml', string $path = "") : array {
        try {
            $rootDir = __DIR__ . "/../../";
            $realPath = $path ? $rootDir . $path : $rootDir;
            $config = file_get_contents($realPath . $file);

            $value = Yaml::parse($config);
        } catch (\Exception $e) {
            throw new \Exception("WrongConfigException : file:$file; path:$path; message:" . $e->getMessage());
        }
        return $value;
    }
}