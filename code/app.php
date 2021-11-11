<?php 

use Chat\Application;
require_once('vendor/autoload.php');

try {
    if(isset($argv[1])) {
        $app = new Application();
        $app->run($argv[1]);
    }
}
catch(Exception $e) {
	echo $e->getMessage();
}
