<?php

declare(strict_types=1);

namespace App\Services;

use App\Dto\ApiAnswerDTO;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

interface View
{

    /**
     * @param ApiAnswerDTO|null $apiAnswerDto
     * @param int $responseCode
     * @return JsonResponse
     */
    public function apiAnswer(ApiAnswerDTO|null $apiAnswerDto, int $responseCode = 200): JsonResponse;

    /**
     * @param bool|null $isOk
     * @param int $responseCode
     * @return Response
     */
    public function booleanAnswer(?bool $isOk, int $responseCode = 200): Response;

    /**
     * @param array|null $array
     * @param int $flags
     * @param int $responseCode
     * @return Response
     */
    public function printArray(?array $array, int $flags = 0, int $responseCode = 200): Response;

    /**
     * @param string|null $value
     * @param int $responseCode
     * @return Response
     */
    public function printValue(?string $value, int $responseCode = 200): Response;

}
