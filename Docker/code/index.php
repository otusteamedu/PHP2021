<?php
require_once('vendor/autoload.php');


try {

    $app = new App\app();

    $app->run();

} catch(Exception $e){

    $e->getMessage();

}

?>