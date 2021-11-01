<?php declare(strict_types=1);

namespace App;

use App\Constants\CliCommands;
use App\Client\Client;
use App\Server\Server;

class App
{
    private ?string $command;

    public function __construct(?array $arguments = null)
    {
        $this->command = $arguments ? array_pop($arguments) : null;
    }

    public function run()
    {
        set_time_limit(0);
        ob_implicit_flush();

        switch ($this->command) {
            case CliCommands::START_SERVER:
                    (new Server())->handle();
                break;
            case CliCommands::START_CLIENT:
                    (new Client())->handle();
                break;
            default:
                    echo 'Please put correct params' . PHP_EOL;
                break;
        }
    }

    public function isAllRun()
    {
        return !!$this->command;
    }
}