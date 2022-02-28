<?php
declare(strict_types=1);

require_once('vendor/autoload.php');

use App\App;

define('ROOT',dirname(__FILE__));

try {

    $app = new App();
    $app->run();

} catch (Exception $e) {
    echo $e->getMessage(). PHP_EOL;
}