<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Modules\Event\Application\Contracts\EventServiceInterface;
use App\Modules\Event\Domain\DTO\CreateEventDTO;
use Illuminate\Console\Command;

class RedisCreate extends Command
{
    protected $signature = 'redis:create';

    public function handle(EventServiceInterface $eventService): void
    {
        $createDTO = new CreateEventDTO(1000, ['params1' => 'boom',], ['send_email', 'send_telegram']);
        $eventService->createEvent($createDTO);


        $createDTO = new CreateEventDTO(2000, ['params1' => 'boom1', 'params2' => 'boom1'], ['send_email', 'send_telegram']);
        $eventService->createEvent($createDTO);

        $createDTO = new CreateEventDTO(3000, ['params1' => 'boom', 'params2' => 'boom3'], ['send_email']);
        $eventService->createEvent($createDTO);
    }
}
