<?php

require_once __DIR__ . "/../../vendor/autoload.php";

use Chat\App;
try {
    $app = new App();
    $app->run($argv);
} catch (Exception $e) {
    echo $e;
}
