<?php
$try_data=['hcsa@ya.ru','hcsa@narod.ru','hcsa@bigdata.com'];
require_once('Webapp/autoload.php');

try {
    $app = new Validator();
    if ($app->check($try_data)) {
        echo 'Test is finished for : ';
        var_dump ($try_data);
    }
}
catch(Exception $e) {
    echo $e->getMessage();
}