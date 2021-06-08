<?php declare(strict_types=1);

namespace App;

use App\Config\Yaml;
use App\IO\Console;
use App\Socket\SocketException;
use App\Socket\UnixSocket;

class App
{
    const CLIENT_MODE = 'client';

    const SERVER_MODE = 'server';

    private array $config = [];

    /**
     * @throws Config\ConfigException
     */
    public function __construct(string $configPath)
    {
        $this->config = Yaml::parse($configPath);
    }

    /**
     * @throws IO\IOException
     * @throws SocketException
     * @throws \InvalidArgumentException
     */
    public function run(string $mode)
    {
        $console = new Console();

        $app = match ($mode) {
            self::SERVER_MODE => new Server(new UnixSocket(), $console, $console),
            self::CLIENT_MODE => new Client(new UnixSocket(), $console, $console),
            default => throw new \InvalidArgumentException("Unexpected mode: $mode")
        };

        $app->run($this->config['socket']['addr'] ?? '');
    }
}
