<?php

$str = "()";

function test(string $str): bool
{
    if ($str === '') {
        return false;
    }

    $stack = [];
    $len   = mb_strlen($str);
    for ($i = 0; $i < $len; $i++) {
        if ($str[$i] === '(') {
            $stack[] = $str[$i];
            continue;
        }

        if ($str[$i] === ')' && array_pop($stack) !== null) {
            continue;
        }

        return false;
    }

    return count($stack) === 0;
}

var_dump(test($str));