<?php
spl_autoload_register(function ($name) {
    include $name . '.php';
});

$requestValidator = new RequestValidator();
echo $requestValidator->validate();