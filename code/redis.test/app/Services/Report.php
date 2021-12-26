<?php

declare(strict_types=1);

namespace App\Services;

use App\Dto\ApiAnswerDTO;

interface Report
{

    /**
     * @param array $data
     * @return ApiAnswerDTO
     */
    public function request(array $data): ApiAnswerDTO;

}
