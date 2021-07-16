<?php
<<<<<<< HEAD
echo "Hello, Otus!";

phpinfo();
=======
use MySite\App;


require_once('../vendor/autoload.php');

try {
    (new App())->run();
} catch (Exception $e) {
    echo $e->getMessage();
}
>>>>>>> SGaponov/hw9
