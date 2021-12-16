<?php

function task1(array $data)
{
    $miss = 0;
    return array_reduce($data, function ($carry, $item) use ($miss) {
        if ($item % 2 !== 0) {
            $carry .= $item;
        }
        return $carry;
    }, '');
}

var_dump(task1([1, 2, 3, 5, 7, 8, 9, 10]));