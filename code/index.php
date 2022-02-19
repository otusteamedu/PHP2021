<?php
$try_data=['hcsa@ya.ru','hcsa@narod.ru','hcsa@bigdata.com'];
require_once('vendor/autoload.php');

try {
    $app = new Validator();
    $result=$app->check($try_data);
    foreach ($try_data as $n=>$email) {
        echo 'Result for string "'.$email.'" is ';
        if ($result[$n]===true) {
            echo ' successed';
        } else {
            echo $result[$n];
        }
        echo '<br>';
    }

}
catch(Exception $e) {
    echo $e->getMessage();
}
