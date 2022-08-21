<?php

declare(strict_types=1);

namespace App;

require_once('vendor/autoload.php');

try {
    (new App())->run();
} catch (\Exception $e) {
    echo $e->getMessage().PHP_EOL;
}