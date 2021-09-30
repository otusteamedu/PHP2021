<?php

declare(strict_types=1);

namespace App\Services\Events\Data;

use App\Services\Events\Common\ArrayCommonService;
use App\Services\Events\Data\Exceptions\FindEventFormatException;

final class FormatDataService
{

    private ArrayCommonService $arrayCommonService;

    public function __construct(ArrayCommonService $arrayCommonService)
    {
        $this->arrayCommonService = $arrayCommonService;
    }

    public function getDataToSearchEvent(array $searchParams): ?array
    {
        if (
            !isset($searchParams['params'])
        ) {
            throw new FindEventFormatException('Неверный формат входных данных! '
                . '(Пример: {"params": { "param1": 1, "param2": 2 }})');
        }
        $arrays = (array)$searchParams['params'];
        return $this->arrayCommonService->implodeArray($arrays);
    }

}
