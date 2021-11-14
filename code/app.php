<?php 

use App\Application;
use App\Response;
require_once('vendor/autoload.php');

try {
    if($_SERVER['REQUEST_METHOD'] != 'POST') {
        throw new \Exception('Wrong request method');
    }
    $app = new Application();
    $response = $app->checkMailList();
    App\Response::generateOkResponse($response); 
}
catch(Exception $e) {
    App\Response::generateBadRequestResponse($e->getMessage());
}
