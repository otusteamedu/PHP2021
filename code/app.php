<?php

require_once('vendor/autoload.php');

use App\App;

//$emailVar = $argv[1];
$arrEmail = ['ifhv94@mail.ru','minyakovaas@mail.ru','113@lum.ru'];

try {


    $app = new App();
    $app->run();


} catch (Exception $e) {
    echo $e->getMessage(). PHP_EOL;
}