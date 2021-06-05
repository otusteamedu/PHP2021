<?php
require "init.php";
use Otus\Chat;
try {
    Chat::run($argv);
} catch (\Exception $e) {
    echo $e->getMessage();
}
