<?php

require_once __DIR__ . '/vendor/autoload.php';

try {
    $app = new \App\App();
    $app->run(); 
}
catch (\ArgumentCountError $e){
    echo  $e->getMessage().PHP_EOL;
}
catch (\InvalidArgumentException $e){
    echo $e->getMessage().PHP_EOL;
}
catch(\Exception $e){
    echo $e->getMessage().PHP_EOL;
}