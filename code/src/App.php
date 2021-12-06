<?php

declare(strict_types=1);

namespace Vshepelev\App;

use Vshepelev\App\Commands\CommandBuilder;
use Vshepelev\App\Exceptions\CommandException;
use Vshepelev\App\Exceptions\ConfigNotFoundException;

class App
{
    private Config $config;

    /**
     * @throws ConfigNotFoundException
     */
    public function __construct(string $appBasePath = __DIR__ . '/..')
    {
        $this->setConsoleSettings();
        $this->initializeConfig($appBasePath);
    }

    /**
     * @throws CommandException
     */
    public function run(...$argv): void
    {
        if (count($argv) === 0) {
            global $argv;
        }

        if (!isset($argv[1])) {
            throw new CommandException('Не передано имя команды.');
        }

        CommandBuilder::build($argv[1], $this->config)->run();
    }

    private function setConsoleSettings(): void
    {
        error_reporting(E_ERROR | E_PARSE);
        set_time_limit(0);
        ob_implicit_flush();
    }

    /**
     * @throws ConfigNotFoundException
     */
    private function initializeConfig($configDir): void
    {
        $this->config = new Config($configDir . '/config.ini');
    }
}
