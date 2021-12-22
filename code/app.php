<?php

use App\App;

require_once('vendor/autoload.php');


try {
    $app = new App(1,2);
    $app->run();
} catch (Exception $e) {
    echo $e->getMessage(). PHP_EOL;
}
