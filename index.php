<?php

function task1(array $data)
{
    $result = [];
    foreach ($data as $num) {
        $result[] = $data;
        if (end($result) !== 1
            && end($result) - $num !== 1) {
            $result[] = $data;
        }
    }
//    return array_reduce($data, function ($carry, $item) {
//        if ($carry !== '') {
//            var_dump($carry);
//            exit();
//        }
//        return $carry . $item;
//    }, '');
}

var_dump(task1([1, 2, 3, 5, 7, 8, 9, 10]));