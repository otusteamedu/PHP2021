<?php

declare(strict_types=1);

namespace App\Services\Events;

use App\Services\Events\Data\FormatDataService;
use App\Services\Events\Repositories\EventRepository;
use App\Services\Events\Math\ArrayMathService;

final class EventService
{

    private EventRepository $repository;
    private ArrayMathService $arrayMathService;
    private FormatDataService $formatDataService;

    public function __construct(
        EventRepository    $repository,
        ArrayMathService   $arrayMathService,
        FormatDataService  $formatDataService
    )
    {
        $this->repository = $repository;
        $this->arrayMathService = $arrayMathService;
        $this->formatDataService = $formatDataService;
    }

    public function addEvent(array $params): bool
    {
        return $this->repository->add($params);
    }

    public function clearData(): bool
    {
        return $this->repository->clear();
    }

    public function getAllConditions(): array
    {
        return $this->repository->getAllConditions();
    }

    public function getAllEvents(): array
    {
        $conditions = $this->getAllConditions();
        return $this->repository->getEvents($conditions);
    }

    public function findEventByParams(array $params): ?string
    {
        $stringParams = $this->formatDataService->getDataToSearchEvent($params);
        $validKeys = $this->arrayMathService->getSubArrays($stringParams, ";");
        return $this->repository->findEventByConditions($validKeys);
    }

}
