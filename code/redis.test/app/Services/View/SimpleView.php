<?php

declare(strict_types=1);

namespace App\Services\View;

use App\Dto\ApiAnswerDTO;
use App\Services\View;

final class SimpleView implements View
{

    /**
     * @inheritDoc
     */
    public function booleanAnswer(?bool $isOk): void
    {
        echo $isOk ? 'OK' : 'Fail';
    }

    /**
     * @inheritDoc
     */
    public function printArray(?array $array, int $flags = 0): void
    {
        echo json_encode($array, $flags);
    }

    /**
     * @inheritDoc
     */
    public function printValue(?string $value): void
    {
        echo $value ?? 'Не найдено';
    }

    public function apiAnswer(?ApiAnswerDTO $apiAnswerDto): void
    {
        echo json_encode([
            'success' => $apiAnswerDto->getSuccess(),
            'data' => $apiAnswerDto->getData(),
        ]);
    }
}
