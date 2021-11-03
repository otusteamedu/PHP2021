<?php

use App\App;

require_once('vendor/autoload.php');

$nameService = $argv[1];

try {
    if(!isset($nameService) | empty($nameService)){
        throw new Exception('Введите название сервиса первым аргументом');
    }
    #Передаем аргумент, кот. говорит, какой сервис запустуть
    $app = new App($nameService);
    $app->run();
} catch (Exception $e) {
    // todo Перехват исключений
    echo $e->getMessage(). PHP_EOL;
}
