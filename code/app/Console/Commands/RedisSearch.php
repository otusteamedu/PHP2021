<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Modules\Event\Application\Contracts\EventServiceInterface;
use App\Modules\Event\Domain\DTO\SearchEventDTO;
use Illuminate\Console\Command;

class RedisSearch extends Command
{
    protected $signature = 'redis:search';

    public function handle(EventServiceInterface $eventService): void
    {
        $createDTO = new SearchEventDTO(['params1' => 'boom',]);

        echo "Events: " . implode(', ', $eventService->getEventByParams($createDTO)) . PHP_EOL;

        $createDTO = new SearchEventDTO(['params1' => 'boom1',]);

        echo "Events: " . implode(', ', $eventService->getEventByParams($createDTO)) . PHP_EOL;
    }
}
