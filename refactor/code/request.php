<?php require_once('vendor/autoload.php');

use Infrastructure\DBConnection;
use Infrastructure\DBAdapter;
use Presentation\RequestHandler;

$dbConnections = new DBConnection();
$dbAdapter = new DBAdapter($dbConnections);
$requestHandler = new RequestHandler($dbAdapter);

$requestHandler->initAction($_REQUEST);
