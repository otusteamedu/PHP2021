<?php
declare(strict_types=1);

require_once('vendor/autoload.php');

use App\App;

define('ROOT',dirname(__FILE__));

try {

    $api = new App();
    $api->run();

} catch (Exception $e) {
    echo $e->getMessage(). PHP_EOL;
}