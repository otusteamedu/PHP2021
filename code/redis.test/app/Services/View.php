<?php

namespace App\Services;

use App\Dto\ApiAnswerDTO;

interface View
{

    /**
     * @param ApiAnswerDTO|null $apiAnswerDto
     */
    public function apiAnswer(?ApiAnswerDTO $apiAnswerDto): void;

    /**
     * @param bool|null $isOk
     */
    public function booleanAnswer(?bool $isOk): void;

    /**
     * @param array|null $array
     * @param int $flags
     */
    public function printArray(?array $array, int $flags = 0): void;

    /**
     * @param string|null $value
     */
    public function printValue(?string $value): void;

}
