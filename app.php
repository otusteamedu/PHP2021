<?php 
require_once('autoload/autoload.php');
use controllers\App;

  try {
    $app = new App();
    $app->run();
  }
    catch(Exception $e){
  }
