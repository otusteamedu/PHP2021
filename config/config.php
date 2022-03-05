<?php

use App\Application\EventControllerInterface;
use App\Application\EventRepositoryInterface;
use App\Infrastructure\EventController;
use App\Infrastructure\EventRepository;

return [
    EventControllerInterface::class => DI\get(EventController::class),
    EventRepositoryInterface::class => DI\get(EventRepository::class),
];
