<?php

declare(strict_types=1);

namespace App\Services\Events\Common;

final class ArrayCommonService
{

    /**
     * @param array $inputArray
     * @param string $keyValueSeparator
     * @param bool $toString
     * @param string $valuesSeparator
     * @return array|string
     */
    public static function implodeArray(
        array  $inputArray,
        string $keyValueSeparator = ":",
        bool   $toString = false,
        string $valuesSeparator = ";"
    ): array|string
    {
        array_walk($inputArray, function (&$value, $key) use ($keyValueSeparator) {
            $value = $key . $keyValueSeparator . $value;
        });
        $returnValue = array_values($inputArray);
        if ($toString) {
            $returnValue = implode($valuesSeparator, $returnValue);
        }
        return $returnValue;
    }


}
