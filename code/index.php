<?php

namespace code;

include_once 'Webapp/Controllers/MainController.php';

use code\Controllers\MainController;

function load_classphp($directory) {
    if (is_dir($directory)) {
        $scan = scandir($directory);
        unset($scan[0], $scan[1]); //unset . and ..
        foreach ($scan as $file) {
            if (is_dir($directory . "/" . $file)) {
                load_classphp($directory . "/" . $file);
            } else {
                if (strpos($file, '.php') !== false) {
                    include_once($directory . "/" . $file);
                }
            }
        }
    }
}

load_classphp('Webapp');
(new MainController())->run();
?>

