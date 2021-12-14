<?php

$files  = array_merge(
    glob('../config/dependencies/*.php' ?: []),
    glob('../config/*.php' ?: [])
);

$config = array_map(function ($file) {
   return require $file;
}, $files);
//var_dump($config);
//var_dump(...$config);
return array_merge_recursive(...$config);
