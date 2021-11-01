<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 31.10.2021
 * Time: 16:18
 */

use app\App;

require_once('vendor/autoload.php');

try {
    if (
        isset($argv) === false ||
        array_key_exists(1, $argv) === false
    ) {
        throw new Exception('Не найдено название сервиса');
    }

    $app = new App($argv[1]);
    $app->run();
} catch (Exception $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

