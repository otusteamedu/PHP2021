<?php

declare(strict_types=1);

namespace Vshepelev\App\Commands;

use Vshepelev\App\Config;
use Vshepelev\App\Exceptions\CommandException;

class CommandBuilder
{
    /**
     * @param string $name
     * @param Config $config
     *
     * @return Command
     * @throws CommandException
     */
    public static function build(string $name, Config $config): Command
    {
        $className = self::getClassNameFromCommandName($name);
        $fullClassName = 'Vshepelev\App\Commands\\' . $className;

        if (!class_exists($fullClassName)) {
            throw new CommandException('Такая команда не найдена.');
        }

        return new $fullClassName($config);
    }

    private static function getClassNameFromCommandName(string $name): string
    {
        $nameParts = explode('-', $name);
        $nameParts = array_map(function ($part) {
            return ucfirst($part);
        }, $nameParts);

        return implode($nameParts);
    }
}
