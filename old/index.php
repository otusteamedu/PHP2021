<?php
use minyakova\EmailVariation\EmailVariation;

require_once('vendor/autoload.php');

$emailVar = $argv[1];

try {

    if(!isset($emailVar)|empty($emailVar)){
        throw new Exception('Введите email первым аргументом');
    }
    $app = new EmailVariation($emailVar);
    $app->run();

} catch (Exception $e) {
    echo $e->getMessage(). PHP_EOL;
}