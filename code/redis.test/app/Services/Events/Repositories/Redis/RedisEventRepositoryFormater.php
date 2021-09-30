<?php

declare(strict_types=1);

namespace App\Services\Events\Repositories\Redis;

use App\Services\Events\Common\ArrayCommonService;
use App\Services\Events\Repositories\Redis\Exceptions\RedisEventFormatException;

final class RedisEventRepositoryFormater
{

    private ArrayCommonService $arrayCommonService;

    public function __construct(ArrayCommonService $arrayCommonService)
    {
        $this->arrayCommonService = $arrayCommonService;
    }

    /**
     * @param array $array
     * @return array
     * @throws RedisEventFormatException
     */
    public function getDataToAddEvent(array $array): array
    {
        if (
            !isset($array['priority'])
            || !is_numeric($array['priority'])
            || !isset($array['conditions'])
            || !is_array($array['conditions'])
            || !isset($array['event'])
            || !is_string($array['event'])
        ) {
            throw new RedisEventFormatException('Неверный формат входных данных! '
                . '(Пример: {"priority": 10, "conditions": { "param1": 1, "param2": 2 }, "event": "event1"})');
        }

        $key = $this->arrayCommonService->implodeArray($array['conditions'], ":", true, ";");

        return [
            'key' => $key,
            'options' => (int)$array['priority'],
            'score' => $array['event'],
        ];
    }

}
