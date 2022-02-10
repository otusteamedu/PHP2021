<?php
$try_data=['hcsa@ya.ru','hcsa@narod.ru','hcsa@bigdata.com'];
require_once('Webapp/autoload.php');

try {
    $app = new Validator();
    if ($result=$app->check($try_data)) {
        echo 'Test is finished for : ';
        var_dump ($try_data);
        echo '<br>Result is - ';
        var_dump ($result);
    }
}
catch(Exception $e) {
    echo $e->getMessage();
}