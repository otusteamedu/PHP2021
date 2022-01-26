<?php
declare(strict_types=1);

require_once('vendor/autoload.php');

define('ROOT',$_SERVER['DOCUMENT_ROOT']);

use App\App;


$fileJsonData = './files/orders.json';

try {

    if(!fopen($fileJsonData,'r')){
        throw new Exception('Проблема с данными и файлом json');
    }

    $app = new App();
    $app->setFileJson($fileJsonData);
    $app->run();

} catch (Exception $e) {
    echo $e->getMessage(). PHP_EOL;
}