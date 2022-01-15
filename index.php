<?php

use App\App;

require_once 'vendor/autoload.php';

try {
    (new App())->run($argv[1]);
} catch (Throwable $e){
    echo $e->getMessage() . PHP_EOL;
}
