<?php
declare(strict_types=1);

require_once('vendor/autoload.php');

use App\App;

define('ROOT',dirname(__FILE__));

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: *");
header("Content-Type: application/json");

try {

    $api = new App();
    $api->run();

} catch (Exception $e) {
    http_response_code();
    echo  $e->getMessage();;
}