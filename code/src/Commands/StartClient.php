<?php

declare(strict_types=1);

namespace Vshepelev\App\Commands;

use Vshepelev\App\Messenger\Client;
use Vshepelev\App\Exceptions\CommandException;
use Vshepelev\App\Messenger\MessengerException;

class StartClient extends BaseCommand
{
    /**
     * @throws CommandException
     */
    public function run(): void
    {
        try {
            (new Client(
                $this->config->get('socket_path'),
                (int) $this->config->get('max_message_length')
            ))->run();
        } catch (MessengerException $e) {
            throw new CommandException($e->getMessage());
        }

    }
}
