<?php

require 'vendor/autoload.php';

use Dmigrishin\Testproject\App;

try{
    $app = new App();
    echo $app->run() . PHP_EOL;

}
catch(Exception $e){
    // …
}