<?php

require_once __DIR__ . '/vendor/autoload.php';

use HW5\App;

$fn = './test_emails.txt';
$emails = file($fn, FILE_IGNORE_NEW_LINES);

try 
{
	$app = new App( $emails );
	$app->run();
}
catch(Exception $e)
{
	echo $e->getMessage();
}