<?php 

use App\Application;
require_once('vendor/autoload.php');

try {
    App\Application::validateRequest();
    $app = new Application();
    $app->checkString();
}
catch(Exception $e) {
    header('HTTP/1.0 400 Bad Request');
	echo $e->getMessage().PHP_EOL;
}
