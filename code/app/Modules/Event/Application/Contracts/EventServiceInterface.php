<?php

declare(strict_types=1);

namespace App\Modules\Event\Application\Contracts;

use App\Modules\Event\Domain\DTO\CreateEventDTO;
use App\Modules\Event\Domain\DTO\SearchEventDTO;

interface EventServiceInterface
{
    public function createEvent(CreateEventDTO $eventDto): void;
    public function getEventByParams(SearchEventDTO $eventDto): array;
}
