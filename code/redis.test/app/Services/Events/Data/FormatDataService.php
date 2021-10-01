<?php

declare(strict_types=1);

namespace App\Services\Events\Data;

use App\Services\Events\Common\ArrayCommonService;
use App\Services\Events\Data\Exceptions\FindEventFormatException;
use App\Services\Events\DTO\SearchEventParamsDTO;

final class FormatDataService
{

    private ArrayCommonService $arrayCommonService;

    public function __construct(ArrayCommonService $arrayCommonService)
    {
        $this->arrayCommonService = $arrayCommonService;
    }

    public function getDataToSearchEvent(SearchEventParamsDTO $searchEventParamsDTO): ?array
    {
        $arrays = $searchEventParamsDTO->getParams();
        return $this->arrayCommonService->implodeArray($arrays);
    }

}
