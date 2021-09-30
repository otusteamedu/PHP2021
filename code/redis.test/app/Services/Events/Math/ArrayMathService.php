<?php

declare(strict_types=1);

namespace App\Services\Events\Math;

final class ArrayMathService
{

    /**
     *
     * Вернуть все подмножества переданного множества
     *
     * @param array $inputArray
     * @param string|null $implodeSeparator
     * @return array
     */
    public function getSubArrays(array $inputArray, ?string $implodeSeparator = null): array
    {
        $n = count($inputArray);
        for ($i = 0, $mx = 1; $i < $n; $i++) {
            $mx *= 2;
        }

        $finalArray = [];

        for ($i = 0; $i < $mx; $i++) {
            for ($j = 0; $j < $n; $j++) {
                if (($i >> $j) & 1) {
                    if (!isset($finalArray[$i])) {
                        $finalArray[$i] = [];
                    }
                    $finalArray[$i][] = $inputArray[$j];
                }
            }
            if (!is_null($implodeSeparator) && isset($finalArray[$i])) {
                $finalArray[$i] = implode(";", $finalArray[$i]);
            }
        }
        return array_values($finalArray);
    }

}
