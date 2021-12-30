<?php

declare(strict_types=1);

namespace App;

use App\Apps\AppFactory;
use App\Apps\AppTypes;
use App\Config\Configuration;
use App\Console\Console;
use Exception;
use UnexpectedValueException;

class App
{
    private const PATH_TO_CONFIG_INI_FILE = '/Config/config.ini';

    public function run(): void
    {
        try {
            $appType = $this->getAppTypeFromCli();
            $this->throwExceptionIfAppTypeIsNotExist($appType);

            $config = $this->getConfig();

            AppFactory::create($appType, $config)->start();
        } catch (Exception $e) {
            Console::error($e->getMessage());
        }
    }

    private function getAppTypeFromCli(): string
    {
        return !empty($_SERVER['argv'][1]) ? $_SERVER['argv'][1] : '';
    }

    private function throwExceptionIfAppTypeIsNotExist(string $appType)
    {
        if (!AppTypes::isExist($appType)) {
            $errorMessage = "Неизвестный параметр $appType. Необходимо указать один из следующих параметров: " . implode(', ', AppTypes::get());
            throw new UnexpectedValueException($errorMessage);
        }
    }

    private function getConfig(): Configuration
    {
        return new Configuration(__DIR__ . self::PATH_TO_CONFIG_INI_FILE);
    }
}
