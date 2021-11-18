<?php

require_once dirname(dirname(__FILE__)) . '/vendor/autoload.php';

use App\App;

$app = new App();

try {
    $response = $app->run();
    echo $response->getMessage() . '<br>';
} catch (Exception $e) {
    echo $e->getMessage();
}
