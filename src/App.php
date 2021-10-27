<?php
namespace Project;

use Project\app\WebApp;
use Project\app\CliApp;

class App
{
    public function run(array $argv = []): bool|int
    {
        match (PHP_SAPI) {
            'cli' => (new CliApp())->run($argv),
            default => (new WebApp())->run(),
        };
    }
}