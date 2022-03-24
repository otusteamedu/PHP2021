<?php
require_once('vendor/autoload.php');

try {
	$app = new APP\App();
	$app->run($argv[1]);
} catch (Exception $e) {
	echo 'Caught exception: ',  $e->getMessage();
}