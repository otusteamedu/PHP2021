<?php

declare(strict_types=1);

namespace App\Services\Events\Common;

final class ArrayCommonService
{

    /**
     * @param array $inputArray
     * @param string $keyValueSeparator
     * @return array
     */
    public function implodeArray(array $inputArray, string $keyValueSeparator = ":"): array
    {
        array_walk($inputArray, function (&$value, $key) use ($keyValueSeparator) {
            $value = $key . $keyValueSeparator . $value;
        });
        $returnValue = array_values($inputArray);
        return $returnValue;
    }

    /**
     * @param array $inputArray
     * @param string $keyValueSeparator
     * @param string $valuesSeparator
     * @return string
     */
    public function implodeArrayString(
        array  $inputArray,
        string $keyValueSeparator = ":",
        string $valuesSeparator = ";"
    ): string
    {
        $returnValue = $this->implodeArray($inputArray, $keyValueSeparator);
        return implode($valuesSeparator, $returnValue);
    }

}
