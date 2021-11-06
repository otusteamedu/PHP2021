<?php

declare(strict_types=1);

namespace App\Services\View;

use App\Dto\ApiAnswerDTO;
use App\Services\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

final class SimpleView implements View
{

    /**
     * @param bool|null $isOk
     * @param int $responseCode
     * @return Response
     */
    public function booleanAnswer(?bool $isOk, int $responseCode = 200): Response
    {
        $answer = $isOk ? 'OK' : 'Fail';
        return response($answer, $responseCode);
    }

    /**
     * @param array|null $array
     * @param int $flags
     * @param int $responseCode
     * @return Response
     */
    public function printArray(?array $array, int $flags = 0, int $responseCode = 200): Response
    {
        $answer = json_encode($array, $flags);
        return response($answer, $responseCode);
    }

    /**
     * @param string|null $value
     * @param int $responseCode
     * @return Response
     */
    public function printValue(?string $value, int $responseCode = 200): Response
    {
        $answer = $value ?? 'Не найдено';
        return response($answer, $responseCode);
    }

    /**
     * @param ApiAnswerDTO|null $apiAnswerDto
     * @param int $responseCode
     * @return JsonResponse
     */
    public function apiAnswer(ApiAnswerDTO|null $apiAnswerDto, int $responseCode = 200): JsonResponse
    {
        $answer = [
            'success' => $apiAnswerDto->getSuccess(),
            'data' => $apiAnswerDto->getData(),
        ];
        return response()->json($answer, $apiAnswerDto->getStatusCode());
    }

}
