<?php
try {
    if (empty($string = $_POST['string'])) {
        throw new Exception();
    }
    $isCoincidence = preg_match("&^([^()]*\((?:[^()]|(?1))*\)[^()]*)+$|^[^()]+?$&", $string);
    if (!$isCoincidence) {
        throw new Exception();
    }
    setStatus(200);
    echo 'Все хорошо';
} catch (Exception) {
    setStatus(400);
    echo 'Все плохо';
}

function setStatus($code) {
    header('Content-Type: text/html; charset=utf-8', false, $code);
}