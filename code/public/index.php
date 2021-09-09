<?php

require_once('../vendor/autoload.php');

use App\App;

try {
    $app = new App();
    $app->run($_SERVER['argv'][1]);
}
catch(Exception $e){
    echo $e->getMessage();
}