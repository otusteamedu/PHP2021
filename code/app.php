<?php

require_once __DIR__ . '/vendor/autoload.php';

use HW5\App;

try
{
	$app = new App( );
	$app->run( $argv );
}
catch(Exception $e)
{
	echo $e->getMessage();
}