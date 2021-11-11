<?php

require_once dirname(dirname(__FILE__)) . '/vendor/autoload.php';

use App\App;

$app = new App('cli');

try {
    $string = '(()()()()))((((()()()))(()()()(((()))))))';

    $response = $app->run($string);

    echo sprintf('App > %s', $response->getMessage()) . PHP_EOL;

} catch (Exception $e) {
    echo $e->getMessage();
}
