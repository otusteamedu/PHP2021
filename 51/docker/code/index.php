<?php

use App\parser\sourceParser;
use App\source\emailSource;
use App\validator\Validator;

require_once('vendor/autoload.php');
try {

    $app = new App\app();
    $app->run();

} catch(Exception $e){

    $e->getMessage();
}
?>