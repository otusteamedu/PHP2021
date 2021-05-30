<?php

require_once './vendor/autoload.php';

$EmailValidator = new EmailValidator();

var_dump($EmailValidator->check("test@mail.ru"));
var_dump($EmailValidator->check("test"));
var_dump($EmailValidator->check("test@unknownhost.ru"));