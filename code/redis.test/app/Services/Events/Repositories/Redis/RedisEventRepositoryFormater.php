<?php

declare(strict_types=1);

namespace App\Services\Events\Repositories\Redis;

use App\Services\Events\Common\ArrayCommonService;
use App\Services\Events\DTO\EventDTO;
use App\Services\Events\DTO\SortedSetMemberDTO;

final class RedisEventRepositoryFormater
{

    /**
     * @var ArrayCommonService
     */
    private ArrayCommonService $arrayCommonService;

    /**
     * @param ArrayCommonService $arrayCommonService
     */
    public function __construct(ArrayCommonService $arrayCommonService)
    {
        $this->arrayCommonService = $arrayCommonService;
    }

    /**
     * @param EventDTO $eventDTO
     * @return array
     */
    public function getDataToAddEvent(EventDTO $eventDTO): SortedSetMemberDTO
    {
        $key = $this->arrayCommonService->implodeArrayString($eventDTO->getConditions(), ":", ";");
        return new SortedSetMemberDTO(
            $key,
            (float)$eventDTO->getPriority(),
            $eventDTO->getEvent()
        );
    }

}
