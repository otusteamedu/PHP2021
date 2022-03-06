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

    /**
     * @param string $id
     * @return ApiAnswerDTO
     */
    public function getStatus(string $id): ApiAnswerDTO;

    /**
     * @param string $id
     * @return ApiAnswerDTO
     */
    public function getData(string $id): ApiAnswerDTO;

}
