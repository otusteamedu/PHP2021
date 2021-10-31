<?php

namespace App\Classes\Config;


use App\Contracts\Config\ConfigReaderContract;
use App\Contracts\Parsers\FileToArrayParserContract;

class FileStoredConfigReader implements ConfigReaderContract
{
    private $config;

    public function __construct(FileToArrayParserContract $parser)
    {
        $this->config = $parser->parse();
    }

    /**
     * @param string $valuePath dot separated path to value
     */
    public function getValue(string $valuePath, $default = null)
    {
        $valuePathParts = explode('.', $valuePath);
        $result = $default;
        $config = $this->config;
        foreach ($valuePathParts as $part) {
            $result = $config[$part] ?? $default;
            $config = $result;
        }

        return $result;
    }
}
