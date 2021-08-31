<?php
namespace Project\app;

use Project\components\chat\Client;
use Project\components\chat\Server;

class CliApp
{
    protected array $config = [];

    public function __construct()
    {
        $this->config = yaml_parse_file(realpath(__DIR__."/../config/console.yaml"));
    }

    public function run(array $argv): void
    {
        try {
            $type = $argv[1] ?? null;
            $message = $argv[2] ?? '';
            match ($type) {
                'server' => (new Server($this->config['socket']))->run(),
                'client' => (new Client($this->config['socket']))->run($message),
            };
        } catch (\UnhandledMatchError $e) {
            echo "Not corrected format!";
        }
    }
}