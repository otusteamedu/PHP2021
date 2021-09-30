<?php

declare(strict_types=1);

namespace App\Services\Events\Common;

final class ViewService
{

    /**
     * @param bool $isOk
     */
    public function booleanAnswer(bool $isOk)
    {
        echo $isOk ? 'OK' : 'Fail';
    }

    /**
     * @param array $array
     */
    public function printArray(array $array)
    {
        echo json_encode($array);
    }

    public function printValue(?string $value)
    {
        echo $value ?? 'Не найдено';
    }

}
