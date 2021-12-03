<?php

declare(strict_types=1);

namespace Vshepelev\App;

use Vshepelev\App\Commands\CommandBuilder;
use Vshepelev\App\Exceptions\CommandException;

class App
{
    private Config $config;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    /**
     * @throws CommandException
     */
    public function run(...$argv): void
    {
        if (!isset($argv[1])) {
            throw new CommandException('Не передано имя команды.');
        }

        CommandBuilder::build($argv[1], $this->config)->run();
    }
}
