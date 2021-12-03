<?php

declare(strict_types=1);

namespace Vshepelev\App\Commands;

use Vshepelev\App\Messenger\Server;
use Vshepelev\App\Exceptions\CommandException;
use Vshepelev\App\Messenger\MessengerException;

class StartServer extends BaseCommand
{
    /**
     * @throws CommandException
     */
    public function run(): void
    {
        try {
            (new Server(
                $this->config->get('socket_path'),
                (int) $this->config->get('max_message_length')
            ))->start();
        } catch (MessengerException $e) {
            throw new CommandException($e->getMessage());
        }
    }
}
