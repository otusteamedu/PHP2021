<?php

use App\Application\Services\Config;

header("Content-type: image/jpg");
$fileId = (int)$_GET["id"];
//$data = file_get_contents(PROJECT_PATH . "/images/" . $fileId . ".jpg");
$data = file_get_contents(Config::getApp('PROJECT_PATH') . "/images/" . 140 . ".jpg");
echo $data;