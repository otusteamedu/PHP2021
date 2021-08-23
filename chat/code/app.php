<?php

require_once __DIR__ . '/vendor/autoload.php';

use HW4\App;


if (!extension_loaded('sockets')) {
	die('The sockets extension is not loaded.');
}



try 
{
	$app = new App();
	$app->run( $argv );
}
catch(Exception $e)
{
	echo $e->getMessage();
}