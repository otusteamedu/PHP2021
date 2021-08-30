<?php
namespace Project;

use Project\components\chat\Client;
use Project\components\chat\Server;

class CliApp
{
    protected array $config = [];

    public function __construct()
    {
        $this->config = require __DIR__ . '/config/console.php';
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
            var_dump("Not corrected format!");
        }
    }
}