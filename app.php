<?php

use App\App;

require_once('vendor/autoload.php');

if(isset($argv[1]) && ($argv[1] == 'server' || $argv[1] == 'client')) {
    try {
        $app = new App();
        $app->run($argv[1]);
    } catch (Exception $e) {
        // Выводим сообщение об ошибке
        echo $e->getMessage().PHP_EOL;
    }
}
else {
    echo "передайте параметр в командной строке server или client".PHP_EOL;
}