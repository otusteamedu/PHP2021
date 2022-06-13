<?php

require_once('vendor/autoload.php');

try {
	$app = new App\Application();
	$app->run();
} catch (Exception $e) {
	App\Infrastructure\Response::generateBadRequestResponse($e->getMessage());
}