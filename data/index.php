<?php

const LAST = 'last';

header('Content-Type: text/plain');

session_start();

echo 'Last: ' . ($_SESSION[LAST] ?? 'Empty string') . PHP_EOL;

$value = $_POST['string'] ?? $_GET['string'] ?? null;

if (is_null($value)) {
    error();
}

$arr = [];

foreach (str_split($value) as $key => $item) {
    if ($item === '(') {
        $arr[] = $key;
        continue;
    }
    if ($item === ')' && is_null(array_pop($arr))) {
        error();
    }
}

if (count($arr) !== 0) {
    error();
}

echo 'Success;';

$_SESSION[LAST] = $value;

session_commit();

function error() {
    echo 'Error;';
    session_abort();
    exit;
}